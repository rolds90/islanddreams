<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('news_date')
                    ->paginate(10);

        $totalNews = News::count();

        return view('admin.news.index', compact('news', 'totalNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news_date = Carbon::parse($request->news_date);
        $slug = Str::slug(Str::lower($request->title . ' ' . $news_date->format('Y-n-j')));

        $data = $this->handleRequest($request);

        $news = News::create([
            'slug'        => $slug,
            'title'       => $data['title'],
            'description' => $data['description'],
            'image'       => $data['image'],
            'news_date'   => $news_date,
            'publish_at'  => $data['publish_at'],
        ]);

        Alert::toast('News ' . $news->title . ' successfully created.', 'success');

        return redirect(route('admin.news.index'));
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        $data['image'] = NULL;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = Str::slug($request['title']) . ".{$ext}";

            $destination = 'images/news/';
            $upload_success = $image->move($destination, $filename);

            if ($upload_success) {
                $width = 908;
                $height = 300;
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
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news_date = Carbon::parse($request->news_date);
        $slug = Str::slug(Str::lower($request->title . ' ' . $news_date->format('Y-n-j')));

        $data = $this->handleRequest($request);

        $news->update([
            'slug'        => $slug,
            'title'       => $data['title'],
            'description' => $data['description'],
            'news_date'   => $news_date,
            'publish_at'  => $data['publish_at'],
        ]);

        if ($data['image']) {
            $news->update([
                'image' => $data['image']
            ]);
        }

        Alert::toast('News ' . $news->title . ' successfully updated.', 'success');

        return redirect(route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        $this->removeImage($news->image);

        Alert::toast('News ' . $news->title . ' successfully deleted.', 'success');

        return redirect(route('admin.news.index'));
    }

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = 'images/news/' . $image;
            $thumbnailPath = 'images/news/thumbs/' . $image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
