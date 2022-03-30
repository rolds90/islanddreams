<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cruise;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        
        $bookings = Booking::join('couriers', 'bookings.courier_id', '=', 'couriers.id')
                        ->select(
                                'slug',
                                DB::raw("'' AS name"),
                                'origin',
                                'destination',
                                'travel_date',
                                'arrival_date',
                                'couriers.name AS courier',
                                DB::raw("'' AS description"),
                                DB::raw("'BOOKING' AS search_at")
                            )
                        ->where([
                            ['travel_date', '>=', Carbon::now()]
                        ])
                        ->when($request->destination, function ($query, $destination) {
                            return $query->where('destination', 'LIKE', '%' . $destination . '%');
                        })
                        ->when($request->from_date, function ($query, $from_date) {
                            return $query->where([
                                ['travel_date', '>=', Carbon::parse($from_date)],
                                ['travel_date', '<=', Carbon::parse($from_date . ' 23:59')],
                            ]);
                        })
                        ->when($request->to_date, function ($query, $to_date) {
                            return $query->where([
                                ['arrival_date', '>=', Carbon::parse($to_date)],
                                ['arrival_date', '<=', Carbon::parse($to_date . ' 23:59')]
                            ]);
                        });
        
        $tours = Tour::select(
                            'slug',
                            'name',
                            DB::raw("'' AS origin"), 
                            DB::raw("'' AS destination"), 
                            'expire_at AS travel_date', 
                            DB::raw("NULL AS arrival_date"),
                            DB::raw("'' AS courier"),
                            'description',
                            DB::raw("'TOUR' AS search_at")
                        )
                    ->where([
                        ['expire_at', '>=', Carbon::now()],
                    ])
                    ->when($request->destination, function ($query, $destination) {
                        return $query->where('location', 'LIKE', '%' . $destination . '%');
                    })
                    ->when($request->from_date, function ($query, $from_date) {
                        return $query->where([
                            ['expire_at', '>=', Carbon::parse($from_date . ' 23:59')]
                        ]);
                    });

        $results = Cruise::select(
                                'slug',
                                'name',
                                'origin',
                                DB::raw("'' AS destination"),
                                'depart_at AS travel_date',
                                DB::raw("NULL AS arrival_date"),
                                'vessel AS courier',
                                DB::raw("'' AS description"),
                                DB::raw("'CRUISE' AS search_at")
                            )
                    ->where([
                        ['depart_at', '>=', Carbon::now()]
                    ])
                    ->when($request->destination, function ($query, $destination) {
                        return $query->where('origin', 'LIKE', '%' . $destination . '%');
                    })
                    ->when($request->from_date, function ($query, $from_date) {
                        return $query->where([
                            ['depart_at', '>=', Carbon::parse($from_date . ' 23:59')]
                        ]);
                    })
                    ->union($bookings)
                    ->union($tours)
                    ->orderBy('travel_date')
                    ->paginate(12);

        return view('search', compact('results'));
    }
}
