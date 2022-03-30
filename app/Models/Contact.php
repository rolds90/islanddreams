<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_no',
        'email',
        'main_contact',
        'main_email',
    ];

    public function mainContactLabel()
    {
        if ($this->main_contact) {
            return '<span class="badge badge-primary ml-2">Yes</span>';
        }

        return '';
    }

    public function mainEmailLabel()
    {
        if ($this->main_email) {
            return '<span class="badge badge-primary ml-2">Yes</span>';
        }

        return '';
    }

    public function scopeMainContactNo($query)
    {
        return $query->where('main_contact', '=', '1');
    }

    public function scopeMainEmail($query)
    {
        return $query->where('main_email', '=', '1');
    }
}
