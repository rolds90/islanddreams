<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::paginate(10);
        $totalAddresses = Address::count();

        return view('admin.address.index', compact('addresses', 'totalAddresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        if ($request->main) {
            // Update all address 'main' column to false
            Address::query()->update(['main' => 0]);
        }

        $address = Address::create($request->toArray());

        Alert::toast('New Address in ' . $address->city . ', ' . $address->country . ' successfully created.', 'success');

        return redirect(route('admin.address.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('admin.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        // ddd($request->all());
        if ($request->main) {
            // Update all address 'main' column to false
            Address::query()->update(['main' => 0]);
        }

        $address->update($request->toArray());

        Alert::toast('Address in ' . $address->city . ', ' . $address->country . ' successfully updated.', 'success');

        return redirect(route('admin.address.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        Alert::toast('Address in ' . $address->city . ', ' . $address->country . ' successfully deleted.', 'success');

        return redirect(route('admin.address.index'));
    }
}
