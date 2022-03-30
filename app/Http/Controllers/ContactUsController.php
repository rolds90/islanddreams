<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $addresses = Address::all();

        $contacts = Contact::all();

        return view('contactus', compact('addresses', 'contacts'));
    }

    public function mail(Request $request)
    {
        $this->validate($request, [
            'firstname'  => 'required|max:60',
            'lastname'   => 'required|max:60',
            'email'      => 'required|email',
            'contact_no' => 'required|numeric',
            'message'    => 'required',
            'g-recaptcha-response' => recaptchaRuleName(),
        ], [
            'validation.recaptcha' => 'Validation with reCaptcha is required.'
        ], [
            'g-recaptcha-response' => 'Google reCaptcha',
        ]);

        Mail::to(env('MAIL_TO_INQUIRY'))
            ->send(new ContactUs($request));

        return redirect()->route('contactus')->with('message', 'Thank you for contacting us, please feel free to browse our site for any services that you may need.');
    }
}
