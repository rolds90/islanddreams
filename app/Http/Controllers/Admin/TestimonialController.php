<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{
    protected $imagePath;

    public function __construct()
    {
        // parent::__construct();
        $this->imagePath = public_path('images/testimonial');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('comment_at')
                                    ->paginate(10);

        $totalTestimonials = Testimonial::count();

        return view('admin.testimonial.index', compact('testimonials', 'totalTestimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        $data = $this->handleRequest($request);

        $testimonial = Testimonial::create([
            'name'       => $data['name'],
            'comment'    => $data['comment'],
            'image'      => $data['image'],
            'comment_at' => $data['comment_at'],
        ]);

        Alert::toast('Testimonial of ' . $testimonial->name . ' successfully created.', 'success');

        return redirect(route('admin.testimonial.index'));
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        $data['image'] = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($request['name'] . '-' . uniqid()) . ".{$ext}";
            $destination = $this->imagePath . '/';

            Image::make($image)
                ->resize(120, 120)
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        ddd($request->all());

        $data = $this->handleRequest($request);
        $prev_image = $testimonial->image;

        $testimonial->update([
            'name'       => $data['name'],
            'comment'    => $data['comment'],
            'comment_at' => $data['comment_at'],
        ]);

        if ($request->has('image')) {
            if ($prev_image !== $data['image']) {
                $this->removeImage($prev_image);
            }
            $testimonial->image = $data['image'];
            $testimonial->update();
        }

        Alert::toast('Testimonial of ' . $testimonial->name . ' successfully updated.', 'success');

        return redirect(route('admin.testimonial.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        $this->removeImage($testimonial->image);

        Alert::toast('Testimonial of ' . $testimonial->name . ' successfully deleted.', 'success');

        return redirect(route('admin.testimonial.index'));
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = $this->imagePath . '/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
        }
    }
}
