<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class HeaderImageController extends Controller
{
    protected $image_path = 'images';
    protected $filename = 'image-top.jpg';

    public function index()
    {
        $image = $this->image_path . '\\' . $this->filename;

        return view ('admin.images.header.index', compact('image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'   =>  ['required', 'image', 'mimes:jpeg,png,jpg', 'max:500']
        ]);

        $destination = public_path($this->image_path);

        // $image = $request->file('image');
        // $ext = $image->getClientOriginalExtension();

        Image::make($request->file('image'))
             ->resize(1920, 110)
             ->contrast(-50)
             ->brightness(30)
             ->blur(10)
             ->save($destination . '\\' . $this->filename);

        Alert::toast('About Us background image successfully replaced.', 'success');

        return redirect(route('admin.images.backgrounds.header.index'));
    }
}
