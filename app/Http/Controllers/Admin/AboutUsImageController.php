<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class AboutUsImageController extends Controller
{
    protected $image_path = 'images\\about';
    protected $filename = 'bg.jpg';

    public function index()
    {
        $image = $this->image_path . '\\' . $this->filename;

        return view('admin.images.aboutus.index', compact('image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'   =>  ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024']
        ]);

        $destination = public_path($this->image_path);

        Image::make($request->file('image'))
             ->resize(1920, 372)
             ->contrast(-45)
             ->save($destination . '\\' . $this->filename);

        Alert::toast('About Us background image successfully replaced.', 'success');

        return redirect(route('admin.images.backgrounds.aboutus.index'));
    }
}
