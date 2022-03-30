<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::published()
                    ->when($request->search, function ($query, $search) {
                        return $query->where('title', 'LIKE', '%' . $search . '%')
                                     ->orWhere('description', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('news_date')
                    ->paginate(10);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
