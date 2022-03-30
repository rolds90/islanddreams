<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CruiseRequest;
use App\Models\Cruise;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cruises = Cruise::when(!is_null($request->get('search')), function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->get('search') . '%')
                            ->orWhere('origin', 'LIKE', '%' . $request->get('search') . '%');
                    })
                    ->orderBy('depart_at')
                    ->paginate(10);

        $totalCruises = Cruise::count();

        return view('admin.cruise.index', compact('cruises', 'totalCruises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cruise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CruiseRequest $request)
    {
        $depart_at = Carbon::parse($request->depart_at);
        $slug = Str::slug(Str::lower($request->name . ' ' . $depart_at->format('Y-n-j')));

        $data = $this->handleRequest($request);

        $cruise = Cruise::create([
            'slug'        => $slug,
            'name'        => $data['name'],
            'origin'      => $data['origin'],
            'description' => $data['description'],
            'vessel'      => $data['vessel'],
            'days'        => $data['days'],
            'nights'      => $data['nights'],
            'image'       => $data['image'],
            'depart_at'   => $depart_at,
            'trip_type'   => $data['trip_type'],
        ]);

        // Images
        if ($request->hasFile('images')) {
            $images = $this->handleImages($request->file('images'), $cruise);

            foreach ($images as $filename) {
                $cruise->images()->create(['image' => $filename]);
            }
        }

        // Itineraries
        if ($request->has('ItineraryFields')) {
            foreach ($request->ItineraryFields as $itinerary) {
                $itinerary_data = $this->handleItinerary($cruise, $itinerary);
                $cruise->itineraries()->create([
                    'day'            => $itinerary_data['day'],
                    'location'       => $itinerary_data['location'],
                    'itinerary_date' => $itinerary_data['itinerary_date'],
                    'depart_at'      => $itinerary_data['depart_at'],
                    'arrive_at'      => $itinerary_data['arrive_at'],
                    'image'          => $itinerary_data['image'],
                ]);
            }
        }

        Alert::toast('Cruise ' . $cruise->name . ' departing on ' . $cruise->depart_at->format('m/d/Y h:i A') . ' successfully created.', 'success');

        return redirect(route('admin.cruise.index'));
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($request['name']) . ".{$ext}";

            $destination = 'images/cruise/';
            Image::make($image)
                ->resize(282, 232)
                ->save($destination . $filename);

            // $upload_success = $image->move($destination, $filename);

            // if ($upload_success) {
                // $width = 282;
                // $height = 232;
                // $destination_thumb = $destination . 'thumbs/';

                // if (!file_exists($destination_thumb)) {
                //     File::makeDirectory($destination_thumb);
                // }

                // Image::make($destination . $filename)
                //     ->resize($width, $height)
                //     ->save($destination_thumb . $filename);
            // }

            $data['image'] = $filename;
        }

        return $data;
    }

    private function handleImages($images, $cruise)
    {
        $data = [];

        foreach ($images as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($cruise->name . '-' . uniqid()) . ".{$ext}";

            $destination = 'images/cruise/images/';
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

    private function handleItinerary($cruise, $itinerary_request)
    {
        $data = $itinerary_request;

        if ($itinerary_request['image']) {
            $itinerary_date = Carbon::parse($itinerary_request['itinerary_date']);
            $image = $itinerary_request['image'];
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug(Str::lower($cruise->name . ' ' . $itinerary_request['location']) . ' ' . $itinerary_date->format('Y-n-j')) . ".{$ext}";

            $destination = 'images/cruise/itinerary/';
            Image::make($image)
                ->resize(262, 232)
                ->save($destination . $filename);

            $data['image'] = $filename;
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
    public function edit(Cruise $cruise)
    {
        return view('admin.cruise.edit', compact('cruise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cruise $cruise)
    {
        $depart_at = Carbon::parse($request->depart_at);
        $slug = Str::slug(Str::lower($request->name . ' ' . $depart_at->format('Y-n-j')));

        $data = $this->handleRequest($request);

        $cruise->update([
            'slug'        => $slug,
            'name'        => $data['name'],
            'origin'      => $data['origin'],
            'description' => $data['description'],
            'vessel'      => $data['vessel'],
            'days'        => $data['days'],
            'nights'      => $data['nights'],
            'depart_at'   => $depart_at,
            'trip_type'   => $data['trip_type'],
        ]);

        if ($request->has('image')) {
            $cruise->image = $data['image'];
            $cruise->update();
        }

        $delete_images = $cruise->images->whereNotIn('image', $request->current_images);
        foreach ($delete_images as $image) {
            $cruise->images->where('image', $image->image)->first()->delete();
            $this->removeImage($image->image);
        }

        if ($request->hasFile('images')) {
            $images = $this->handleImages($request->file('images'), $cruise);

            foreach ($images as $filename) {
                $cruise->images()->create(['image' => $filename]);
            }
        }

        if ($request->has('ItineraryFields')) {
            $delete_itineraries = $cruise->itineraries->whereNotIn('id', Arr::pluck($request->ItineraryFields, 'id'));
            foreach ($delete_itineraries as $itinerary) {
                $this->removeItineraryImage($itinerary->image);
                $itinerary->delete();
            }

            foreach ($request->ItineraryFields as $itinerary) {
                if(!Arr::exists($itinerary, 'id')) {
                    $itinerary_data = $this->handleItinerary($cruise, $itinerary);
                    $cruise->itineraries()->create([
                        'day'            => $itinerary_data['day'],
                        'location'       => $itinerary_data['location'],
                        'itinerary_date' => $itinerary_data['itinerary_date'],
                        'depart_at'      => $itinerary_data['depart_at'],
                        'arrive_at'      => $itinerary_data['arrive_at'],
                        'image'          => $itinerary_data['image'],
                    ]);
                }
            }
        } else {
            $cruise->itineraries()->delete();
        }

        Alert::toast('Cruise ' . $cruise->name . ' departing on ' . $cruise->depart_at->format('m/d/Y h:i A') . ' successfully updated.', 'success');

        return redirect(route('admin.cruise.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cruise $cruise)
    {
        $this->removeMainImage($cruise->image);
        foreach ($cruise->images as $image) {
            $this->removeImage($image->image);
        }

        foreach ($cruise->itineraries as $itinerary) {
            $this->removeItineraryImage($itinerary->image);
        }

        $cruise->delete();

        Alert::toast('Cruise ' . $cruise->name . ' successfully deleted.', 'success');

        return redirect(route('admin.cruise.index'));
    }

    private function removeMainImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/cruise/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
        }
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/cruise/images/' . $image;
            $thumbnailPath = 'images/cruise/images/thumbs/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    private function removeItineraryImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/cruise/itinerary/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
        }
    }
}
