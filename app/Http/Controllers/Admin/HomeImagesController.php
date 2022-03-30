<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class HomeImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = HomeImages::orderBy('sort')->paginate(10);
        $totalImages = HomeImages::count();

        return view('admin.images.home.index', compact('images', 'totalImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.home.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'images'   => 'required',
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:500']
        ]);

        $destination = 'images/slider/';

        $lastSort = HomeImages::max('sort');

        foreach ($request->file('images') as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = str_replace(".{$ext}", "", $image->getClientOriginalName());
            $filename = Str::slug($filename) . ".{$ext}";

            Image::make($image)
                 ->resize(1920, 950)
                 ->save($destination . $filename);

            $lastSort++;

            HomeImages::create([
                'sort'  => $lastSort,
                'image' => $filename
            ]);
        }

        Alert::toast('Slider Images successfully uploaded.', 'success');

        return redirect(route('admin.images.home.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = HomeImages::findOrFail($id);
        return view('admin.images.home.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sort'   => 'required|numeric'
        ]);

        $image = HomeImages::findOrFail($id);

        $image->sort = $request->sort;
        $image->save();

        Alert::toast('Slider Image successfully updated.', 'success');

        return redirect(route('admin.images.home.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = HomeImages::findOrFail($id);

        if(HomeImages::count() > 1) {
            $image->delete();

            $this->removeImage($image->image);

            Alert::toast('Image successfully deleted.', 'success');
        } else {
            Alert::error('Last Image', 'Cannot delete last remaining image, atleast 1 image should remain from the slider.');
        }

        return redirect(route('admin.images.home.index'));
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/slider/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
        }
    }
}
