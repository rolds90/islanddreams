<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Mail\Markdown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'image',
        'news_date',
        'publish_at'
    ];

    protected $casts = [
        'news_date' => 'datetime',
        'publish_at' => 'datetime'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('publish_at', '<=', Carbon::now());
    }

    public function publicationLabel()
    {
        if (!$this->publish_at) {
            return '<span class="badge badge-warning">Draft</span>';
        } elseif ($this->publish_at && $this->publish_at->isFuture()) {
            return '<span class="badge badge-primary">Scheduled</span>';
        } else {
            return '<span class="badge badge-info">Published</span>';
        }
    }

    public function getExcerptAttribute()
    {
        $html = Markdown::parse($this->description);

        return Str::words(strip_tags($html), 15);
    }

    public function getDescriptionHtmlAttribute($value)
    {
        return $this->description ? nl2br(Markdown::parse(e($this->description))) : null;
    }

    public function getImageThumbUrlAttribute()
    {
        $imgDir = 'images/news/thumbs';
        $imagePath = public_path() . "/{$imgDir}/idts.jpg";
        $imageURL = (file_exists($imagePath)) ? asset("{$imgDir}/idts.jpg") : "";

        if (!is_null($this->image)) {
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/news';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }
}
