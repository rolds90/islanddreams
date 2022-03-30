<?php

namespace App\Http\Controllers;

use App\Mail\Booking as MailBooking;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'AIR');
        $bookings = Booking::with('courier')->where([
                        ['type', '=', $type],
                        ['travel_date', '>=', Carbon::now()],
                        // ['travel_time', '>=', Carbon::now()->toTimeString()],
                    ])
                    ->when($request->origin, function($query, $origin){
                        return $query->where('origin', $origin);
                    })
                    ->when($request->destination, function ($query, $destination) {
                        return $query->where('destination', $destination);
                    })
                    ->when($request->depart_date, function ($query, $depart_date) {
                        // $travel_date = Carbon::parse($depart_date);
                        return $query->where([
                            ['travel_date', '=', Carbon::parse($depart_date)],
                            // ['travel_time', '>=', $travel_date->toTimeString()]
                        ]);
                    })
                    ->when($request->arrive_date, function ($query, $arrive_date) {
                        // $arrival_date = Carbon::parse($arrive_date);
                        return $query->where([
                            ['arrival_date', '=', Carbon::parse($arrive_date)],
                            // ['arrival_time', '>=', $arrival_date->toTimeString()],
                        ]);
                    })
                    ->orderBy('travel_date')
                    ->paginate(9);

        return view('booking.index', compact('bookings', 'type'));
    }

    public function show(Booking $booking)
    {
        abort_if($booking->travel_date < Carbon::now(), Response::HTTP_NOT_FOUND, '404 Not Found');

        // sample parse of date (making slug)
        // $date = '2022-02-13 13:00';
        // $parse_date = Carbon::parse($date);
        // return Str::lower(Str::slug('air cebu pacific ' . $parse_date->format("y-m-d-H-i")));

        return view('booking.show', compact('booking'));
    }

    public function inquire(Request $request, Booking $booking)
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
            ->send(new MailBooking($request, $booking));

        return redirect()->route('booking')->with('message', 'We will be in contact with you once the inquiry is checked by our agents.');
    }
}
