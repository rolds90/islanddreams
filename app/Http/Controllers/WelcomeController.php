<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use App\Models\HomeImages;
use App\Models\Promo;
use App\Models\Testimonial;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $images = HomeImages::orderBy('sort')->get();

        $tours = Tour::where('expire_at', '>=', Carbon::now())
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

        $promos = Promo::where([
                        ['date_start', '<=', Carbon::now()],
                        ['date_end', '>=', Carbon::now()],
                    ])
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

        $cruises = Cruise::where('depart_at', '>=', Carbon::now())
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

        $testimonials = Testimonial::inRandomOrder()
                    ->limit(5)
                    ->get();

        return view('welcome', compact('images', 'tours', 'promos', 'cruises', 'testimonials'));
    }
}
