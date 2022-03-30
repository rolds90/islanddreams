<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseItineraries extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'location',
        'itinerary_date',
        'depart_at',
        'arrive_at',
        'image'
    ];

    protected $casts = [
        'itinerary_date' => 'date',
        'arrive_at'      => 'datetime',
        'depart_at'      => 'datetime'
    ];

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/cruise/itinerary';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }
}
