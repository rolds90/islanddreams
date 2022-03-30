<?php

namespace App\Http\Controllers;

use App\Mail\Tour as MailTour;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller
{
    protected $contact_no;
    protected $email;

    public function __construct()
    {
        $this->contact_no = Contact::mainContactNo()->inRandomOrder()->limit(2)->get()->pluck('contact_no')->implode(' | ');
        $this->email      = Contact::mainEmail()->get()->pluck('email')->pop();
    }

    public function index(Request $request) {
        $tours = Tour::with('images')->where([
                        ['expire_at', '>=', Carbon::now()],
                        // ['travel_time', '>=', Carbon::now()->toTimeString()],
                    ])
                    ->when($request->location, function ($query, $location) {
                        return $query->where('location', $location);
                    })
                    ->when($request->tour_date, function ($query, $tour_date) {
                        // $travel_date = Carbon::parse($depart_date);
                        return $query->where([
                            ['expire_at', '>=', Carbon::parse($tour_date)],
                            // ['travel_time', '>=', $travel_date->toTimeString()]
                        ]);
                    })
                    ->orderBy('expire_at')
                    ->paginate(10);

        return view('tour.index', compact('tours'));
    }

    public function show(Tour $tour)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('tour.show', compact('tour', 'contact_no', 'email'));
    }

    public function inquire(Tour $tour)
    {
        $contact_no = $this->contact_no;
        $email      = $this->email;

        return view('tour.book', compact('tour', 'contact_no', 'email'));
    }

    public function mail(Request $request, Tour $tour)
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
            ->send(new MailTour($request, $tour));

        return redirect()->route('tour')->with('message', 'We will be in contact with you once the inquiry is checked by our agents.');
    }
}
