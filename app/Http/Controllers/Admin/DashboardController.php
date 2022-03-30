<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $addresses = Address::all();

        $contact_nos = Contact::where('contact_no','<>',NULL)->get();
        $emails = Contact::where('email', '<>', NULL)->get();

        return view('dashboard', compact('addresses', 'contact_nos', 'emails'));
    }
}
