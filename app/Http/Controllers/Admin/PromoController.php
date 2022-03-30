<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoRequest;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::where([
                        ['date_start', '<=', Carbon::now()],
                        ['date_end', '>=', Carbon::now()],
                    ])
                    ->paginate(10);

        $totalPromos = Promo::count();

        return view('admin.promo.index', compact('promos', 'totalPromos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request)
    {
        $date_start = Carbon::parse($request->date_start);
        $slug = Str::slug(Str::lower($request->title . ' ' . $date_start->format('Y-n-j')));

        $data = $this->handleRequest($request);

        $promo = Promo::create([
            'slug'        => $slug,
            'title'       => $data['title'],
            'description' => $data['description'],
            'image'       => $data['image'],
            'date_start'  => $date_start,
            'date_end'    => $data['date_end'],
        ]);

        Alert::toast('Promo ' . $promo->title . ' starting on ' . $promo->date_start->format('m/d/Y') . ' successfully created.', 'success');

        return redirect(route('admin.promo.index'));
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($request['title']) . ".{$ext}";
            $destination = 'images/promo/';

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
    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromoRequest $request, Promo $promo)
    {
        Alert::toast('Promo ' . $promo->title . ' starting on ' . $promo->date_start->format('m/d/Y') . ' successfully created.', 'success');

        return redirect(route('admin.promo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $promo->delete();

        $this->removeImage($promo->image);

        Alert::toast('Promo ' . $promo->title . ' starting on ' . $promo->date_start->format('m/d/Y') . ' successfully created.', 'success');

        return redirect(route('admin.promo.index'));
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/promo/' . $image;
            $thumbnailPath = 'images/promo/thumbs/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
