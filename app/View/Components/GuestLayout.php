<?php

namespace App\View\Components;

use App\Models\Address;
use App\Models\Contact;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest', [
            'address'    => Address::main()->first()->full_address,
            'contact_no' => Contact::mainContactNo()->inRandomOrder()->limit(2)->get()->pluck('contact_no')->implode(' | '),
            'email'      => Contact::mainEmail()->get()->pluck('email')->pop(),
        ]);
    }
}
