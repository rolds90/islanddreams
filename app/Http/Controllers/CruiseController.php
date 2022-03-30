<?php

namespace App\Http\Controllers;

use App\Mail\Cruise as MailCruise;
use App\Models\Contact;
use App\Models\Cruise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CruiseController extends Controller
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
        $cruises = Cruise::with('images')
            ->where([
                ['depart_at', '>=', Carbon::now()]
            ])
            ->when($request->location, function ($query, $location) {
                return $query->where('location', $location);
            })
            ->when($request->tour_date, function ($query, $tour_date) {
                // $travel_date = Carbon::parse($depart_date);
                return $query->where([
                    ['depart_at', '>=', Carbon::parse($tour_date)],
                    // ['travel_time', '>=', $travel_date->toTimeString()]
                ]);
            })
            ->orderBy('depart_at')
            ->paginate(10);

        return view('cruise.index', compact('cruises'));
    }

    public function show(Cruise $cruise)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('cruise.show', compact('cruise', 'contact_no', 'email'));
    }

    public function inquire(Cruise $cruise)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('cruise.book', compact('cruise', 'contact_no', 'email'));
    }

    public function mail(Request $request, Cruise $cruise)
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
            ->send(new MailCruise($request, $cruise));

        return redirect()->route('cruise')->with('message', 'We will be in contact with you once the inquiry is checked by our agents.');
    }
}
