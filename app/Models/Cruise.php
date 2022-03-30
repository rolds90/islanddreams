<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;

class Cruise extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'origin',
        'vessel',
        'days',
        'nights',
        'image',
        'depart_at',
        'trip_type'
    ];

    protected $casts = [
        'depart_at' => 'date'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(CruiseImages::class);
    }

    public function itineraries()
    {
        return $this->hasMany(CruiseItineraries::class);
    }

    public function getExcerptAttribute()
    {
        $html = Markdown::parse($this->description);

        return Str::words(strip_tags($html), 10);
    }

    public function getDescriptionHtmlAttribute($value)
    {
        return $this->description ? nl2br(Markdown::parse(e($this->description))) : null;
    }

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/cruise';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }

    public function getDurationAttribute()
    {
        return $this->days . ' ' . Str::plural('Day', $this->days) . ' / ' . $this->nights . ' ' . Str::plural('Night', $this->nights);
    }
}
