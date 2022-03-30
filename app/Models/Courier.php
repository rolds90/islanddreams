<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/courier';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }
}
