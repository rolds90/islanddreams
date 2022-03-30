<?php

namespace App\Http\Controllers;

use App\Mail\Promo as MailPromo;
use App\Models\Contact;
use App\Models\Promo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PromoController extends Controller
{
    protected $contact_no;
    protected $email;

    public function __construct()
    {
        $this->contact_no = Contact::mainContactNo()->inRandomOrder()->limit(2)->get()->pluck('contact_no')->implode(' | ');
        $this->email      = Contact::mainEmail()->get()->pluck('email')->pop();
    }

    public function index(Request $request)
    {
        $promos = Promo::where([
                        ['date_start', '<=', Carbon::now()],
                        ['date_end', '>=', Carbon::now()],
                    ])->paginate(9);

        return view('promo.index', compact('promos'));
    }

    public function show(Promo $promo)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('promo.show', compact('promo', 'contact_no', 'email'));
    }

    public function inquire(Promo $promo)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('promo.book', compact('promo', 'contact_no', 'email'));
    }

    public function mail(Request $request, Promo $promo)
    {
        $this->validate($request, [
            'firstname'  => 'required|max:60',
            'lastname'   => 'required|max:60',
            'email'      => 'required|email',
            'contact_no' => 'required|numeric',
            'message'    => 'nullable',
            'g-recaptcha-response' => recaptchaRuleName(),
        ]);

        Mail::to(env('MAIL_TO_INQUIRY'))
        ->send(new MailPromo($request, $promo));

        return redirect()->route('promo')->with('message', 'We will be in contact with you once the inquiry is checked by our agents.');
    }
}
