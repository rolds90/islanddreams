<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class LegitimacyImagesController extends Controller
{
    protected $image_path = 'images\\about\\proof';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filesystem = New Filesystem;
        $files = $filesystem->files($this->image_path);

        return view('admin.images.legitimacy.index', compact('files'));
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

        foreach ($request->file('images') as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = str_replace(".{$ext}", "", $image->getClientOriginalName());
            $filename = Str::slug($filename) . ".{$ext}";

            $image->move($this->image_path, $filename);
        }

        Alert::toast('Legitimacy Images successfully uploaded.', 'success');

        return redirect(route('admin.images.legitimacy.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        $imagePath = $this->image_path . '\\' .  $filename;

        if (file_exists($imagePath)) {
            unlink($imagePath);

            Alert::toast('Legitimacy Image successfully deleted.', 'success');
        } else {
            Alert::toast('Legitimacy Image could not be deleted.', 'error');
        }        

        return redirect(route('admin.images.legitimacy.index'));
    }
}
