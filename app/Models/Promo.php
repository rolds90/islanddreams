<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Str;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'date_start',
        'date_end',
        'description',
        'image'
    ];

    protected $casts = [
        'date_start'  => 'date',
        'date_end' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/promo';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }

    public function getImageThumbUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/promo/thumbs';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }

    public function getExcerptAttribute()
    {
        $html = Markdown::parse($this->description);

        return Str::words(strip_tags($html), 10);
    }

    public function getDescriptionHtmlAttribute()
    {
        return $this->description ? nl2br(Markdown::parse(e($this->description))) : null;
    }
}
