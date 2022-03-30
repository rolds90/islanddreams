<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
        'origin',
        'destination',
        'travel_date',
        'arrival_date',
        'courier_id',
        'image'
    ];

    protected $casts = [
        'travel_date'  => 'datetime',
        'arrival_date' => 'datetime',
    ];

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function getImageUrlAttribute()
    // {
    //     $imageURL = "";

    //     if (!is_null($this->image)) {
    //         $imgDir = 'images/courier';
    //         $imagePath = public_path() . "/{$imgDir}/" . $this->image;
    //         if (file_exists($imagePath)) $imageURL = asset("{$imgDir}/" . $this->image);
    //     }

    //     return $imageURL;
    // }

    public function getTotalTimeAttribute() {
        $duration = $this->arrival_date->diff($this->travel_date);

        $duration_word = $duration->d ? $duration->d . ' ' . Str::plural('day', $duration->d) : '';
        $duration_word .= $duration->h ? ($duration_word ? ", " : "") . $duration->h . ' ' . Str::plural('hour', $duration->h) : '';
        $duration_word .= $duration->i ? ($duration_word ? ", " : "") . $duration->i . ' ' . Str::plural('minute', $duration->i) : '';

        return $duration_word;
    }

    // public function getTravelTimeAttribute()
    // {
    //     return Carbon::createFromFormat('H:i:s', $this->attributes['travel_time']);
    // }

    // public function getArrivalTimeAttribute()
    // {
    //     return Carbon::createFromFormat('H:i:s', $this->attributes['arrival_time']);
    // }  
}
