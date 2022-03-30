<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'barangay',
        'city',
        'zip_code',
        'country',
        'main'
    ];

    protected $appends = [
        'full_address',
    ];

    public function scopeMain($query)
    {
        return $query->where('main', '=', '1');
    }

    public function getFullAddressAttribute()
    {
        $address = ($this->street ?? $this->steet);
        $address .= ($address ? ', ' : '') . $this->barangay;
        $address .= ($address ? ', ' : '') . $this->city;
        $address .= ($address && $this->zip_code ? ' ' : '') . $this->zip_code;
        $address .= ($address ? ' ' : '') . $this->country;

        return $address;
    }

    public function mainLabel()
    {
        if ($this->main) {
            return '<span class="badge badge-primary ml-2">Main</span>';
        }

        return '';
    }
}
