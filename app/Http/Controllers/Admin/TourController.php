<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\Tour;
use App\Models\TourImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tours = Tour::when(!is_null($request->get('search')), function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('location', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->get('search') . '%');
                    })
                    ->orderBy('expire_at')
                    ->paginate(10);

        $totalTours = Tour::count();

        return view('admin.tour.index', compact('tours', 'totalTours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        $expire_at = Carbon::parse($request->expire_at);
        $slug = Str::slug(Str::lower($request->name . ' ' . $expire_at->format('Y-n-j')));

        // ddd($request);

        $data = $this->handleRequest($request);

        $tour = Tour::create([
            'slug'        => $slug,
            'name'        => $data['name'],
            'location'    => $data['location'],
            'description' => $data['description'],
            'days'        => $data['days'],
            'nights'      => $data['nights'],
            'image'       => $data['image'],
            'expire_at'   => $expire_at,
        ]);

        // Images
        if ($request->hasFile('images')) {
            $images = $this->handleImages($request->file('images'), $tour);

            foreach ($images as $filename) {
                $tour->images()->create(['image' => $filename]);
            }
        }

        // Itineraries
        if ($request->has('ItineraryFields')) {
            foreach ($request->ItineraryFields as $itinerary) {
                $tour->itineraries()->create([
                    'day'         => $itinerary['day'],
                    'title'       => $itinerary['title'],
                    'description' => $itinerary['description']
                ]);
            }
        }

        // Inclusions
        if ($request->has('InclusionFields')) {
            foreach ($request->InclusionFields as $inclusion) {
                $tour->inclusions()->create(['description' => $inclusion['description']]);
            }
        }

        Alert::toast('Tour ' . $tour->name . ' ending on ' . $tour->expire_at->format('m/d/Y h:i A') . ' successfully created.', 'success');

        return redirect(route('admin.tour.index'));
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($request['name']) . ".{$ext}";
            $destination = 'images/tour/';

            $upload_success = $image->move($destination, $filename);

            if ($upload_success) {
                $width = 370;
                $height = 302;
                $destination_thumb = $destination . 'thumbs/';

                if (!file_exists($destination_thumb)) {
                    File::makeDirectory($destination_thumb);
                }

                Image::make($destination . $filename)
                    ->resize($width, $height)
                    ->save($destination_thumb . $filename);
            }

            $data['image'] = $filename;
        }

        return $data;
    }

    private function handleImages($images, $tour)
    {
        $data = [];

        foreach($images as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($tour->name . '-' . uniqid()) . ".{$ext}";

            $destination = 'images/tour/images/';
            Image::make($image)
                ->resize(870, 400)
                ->save($destination . $filename);

            $width = 75;
            $height = 75;
            $destination_thumb = $destination . 'thumbs/';

            if (!file_exists($destination_thumb)) {
                File::makeDirectory($destination_thumb);
            }

            Image::make($destination . $filename)
                ->resize($width, $height)
                ->save($destination_thumb . $filename);

            $data[] = $filename;
        }

        return $data;
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
    public function edit(Tour $tour)
    {
        return view('admin.tour.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        // $images = TourImages::where('tour_id', $tour->id)
        //                 ->whereNotIn('image', $request->current_images)->get();

        $expire_at = Carbon::parse($request->expire_at);
        $slug = Str::slug(Str::lower($request->name . ' ' . $expire_at->format('Y-n-j')));

        // ddd($request);

        $data = $this->handleRequest($request);

        $tour->update([
            'slug'        => $slug,
            'name'        => $data['name'],
            'location'    => $data['location'],
            'description' => $data['description'],
            'days'        => $data['days'],
            'nights'      => $data['nights'],
            'expire_at'   => $expire_at,
        ]);

        if($request->has('image')) {
            $tour->image = $data['image'];
            $tour->update();
        }

        $delete_images = $tour->images->whereNotIn('image', $request->current_images);
        foreach ($delete_images as $image) {
            $tour->images->where('image', $image->image)->first()->delete();
            $this->removeImage($image->image);
        }

        if ($request->hasFile('images')) {
            $images = $this->handleImages($request->file('images'), $tour);

            foreach ($images as $filename) {
                $tour->images()->create(['image' => $filename]);
            }
        }

        // Itineraries
        $tour->itineraries()->delete();
        if ($request->has('ItineraryFields')) {
            foreach ($request->ItineraryFields as $itinerary) {
                $tour->itineraries()->create([
                    'day'         => $itinerary['day'],
                    'title'       => $itinerary['title'],
                    'description' => $itinerary['description']
                ]);
            }
        }

        // Inclusions
        $tour->inclusions()->delete();
        if ($request->has('InclusionFields')) {
            foreach ($request->InclusionFields as $inclusion) {
                $tour->inclusions()->create(['description' => $inclusion['description']]);
            }
        }

        Alert::toast('Tour ' . $tour->name . ' successfully updated.', 'success');

        return redirect(route('admin.tour.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $this->removeMainImage($tour->image);
        foreach($tour->images as $image)
        {
            $this->removeImage($image->image);
        }

        $tour->delete();

        Alert::toast('Tour ' . $tour->name . ' successfully deleted.', 'success');

        return redirect(route('admin.tour.index'));
    }

    private function removeMainImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/tour/' . $image;
            $thumbnailPath = 'images/tour/thumbs/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/tour/images/' . $image;
            $thumbnailPath = 'images/tour/images/thumbs/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
