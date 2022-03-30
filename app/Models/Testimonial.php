<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_at',
        'name',
        'comment',
        'image'
    ];

    protected $casts = [
        'comment_at' => 'date'
    ];

    public function getImageUrlAttribute()
    {
        $imageURL = "";

        if (!is_null($this->image)) {
            $imgDir = 'images/testimonial';
            $imagePath = public_path() . "/{$imgDir}/" . $this->image;
            if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
        }

        return $imageURL;
    }
}
