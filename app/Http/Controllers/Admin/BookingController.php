<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Imports\BookingImport;
use App\Models\Booking;
use App\Models\Courier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::when(!is_null($request->get('search')), function ($query) use ($request) {
                            $query->where('origin', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('destination', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('courier', 'LIKE', '%' . $request->get('search') . '%');
                        })
                        ->orderBy('travel_date')
                        ->paginate(10);

        $totalBookings = Booking::count();

        return view('admin.booking.index', compact('bookings', 'totalBookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $couriers = Courier::all();

        return view('admin.booking.create', compact('couriers'));
    }

    public function upload()
    {
        return view('admin.booking.upload');
    }

    public function import(Request $request)
    {
        Excel::import(new BookingImport, $request->file('import'));

        Alert::toast('Bookings imported successfully created.', 'success');

        return redirect(route('admin.booking.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        $courier = Courier::findOrFail($request->courier_id);
        $travel_date = Carbon::parse($request->travel_date);
        $arrival_date = Carbon::parse($request->arrival_date);
        $slug = Str::slug(Str::lower($request->type . ' ' . $courier->name . ' ' . $request->origin . ' ' . $request->destination . ' ' . $travel_date->format('Y-n-j-G-i')));

        $booking = Booking::create([
            'slug'         => $slug,
            'type'         => $request['type'],
            'origin'       => Str::ucfirst($request['origin']),
            'destination'  => Str::ucfirst($request['destination']),
            'travel_date'  => $travel_date,
            'arrival_date' => $arrival_date,
            'courier_id'   => $courier->id,
        ]);

        Alert::toast('New Booking ' . $booking->origin . ' - ' . $booking->destination . ' at ' . $travel_date->format('m/d/Y h:i A') . ' successfully created.', 'success');

        return redirect(route('admin.booking.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $couriers = Courier::all();

        return view('admin.booking.edit', compact('couriers', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $courier = Courier::findOrFail($request->courier_id);
        $travel_date = Carbon::parse($request->travel_date);
        $arrival_date = Carbon::parse($request->arrival_date);
        $slug = Str::slug(Str::lower($request->type . ' ' . $courier->name . ' ' . $request->origin . ' ' . $request->destination . ' ' . $travel_date->format('Y-n-j-G-i')));

        $booking->update([
            'slug'         => $slug,
            'type'         => $request['type'],
            'origin'       => Str::ucfirst($request['origin']),
            'destination'  => Str::ucfirst($request['destination']),
            'travel_date'  => $travel_date,
            'arrival_date' => $arrival_date,
            'courier_id'   => $courier->id,
        ]);

        Alert::toast('Booking for ' . $booking->origin . ' - ' . $booking->destination . ' at ' . $booking->travel_date->format('m/d/Y h:i A') . ' successfully updated.', 'success');

        return redirect(route('admin.booking.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        Alert::toast('Booking for ' . $booking->origin . ' - ' . $booking->destination . ' at ' . $booking->travel_date->format('m/d/Y h:i A') . ' successfully deleted.', 'success');

        return redirect(route('admin.booking.index'));
    }
}
