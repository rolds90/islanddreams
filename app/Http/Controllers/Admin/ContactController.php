<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        $totalContacts = Contact::count();

        return view('admin.contact.index', compact('contacts', 'totalContacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        if ($request->main_email) {
            // Update all address 'main' column to false
            Contact::query()->update(['main_email' => 0]);
        }

        $contact = Contact::create($request->toArray());

        Alert::toast('New Contact ' . $contact->name . ' successfully created.', 'success');

        return redirect(route('admin.contact.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        if ($request->main_email) {
            // Update all address 'main' column to false
            Contact::query()->update(['main_email' => 0]);
        }

        $contact->update($request->toArray());

        Alert::toast('Contact ' . $contact->name . ' successfully updated.', 'success');

        return redirect(route('admin.contact.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        Alert::toast('Contact ' . $contact->name . ' successfully deleted.', 'success');

        return redirect(route('admin.contact.index'));
    }
}
