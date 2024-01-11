<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Kiosk;
use Illuminate\Http\Request;

class KioskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Kiosk::class);
        $businessTypes = BusinessType::pluck('name', 'id');

        $kiosks = Kiosk::All();
        return view('kiosks.index', compact('kiosks', 'businessTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Kiosk::class);

        $businessTypes = BusinessType::pluck('name', 'id');

        return view('kiosks.create', compact('businessTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new Kiosk instance and fill it with the validated data
        $kiosk = new Kiosk();
        $kiosk->name = $request->input('name');
        $kiosk->business_type_id = $request->input('business_type_id');
        $kiosk->status = $request->input('status');
        $kiosk->location = $request->input('location');

        // Save the Kiosk instance to the database
        $kiosk->save();
        return redirect()->route('kiosks.index')->with('success', 'Kiosk Inserted Successfully');
    }

 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kiosk = Kiosk::find( $id );
        $kiosk->name = $request->input('name');
        $kiosk->business_type_id = $request->input('business_type_id');
        $kiosk->status = $request->input('status');
        $kiosk->location = $request->input('location');
        $kiosk->save();
        return redirect()->route('kiosks.index')->with('success', 'Kiosk Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kiosk = Kiosk::find($id);
        $kiosk ->delete($kiosk);
        return redirect()->route('kiosks.index')
            ->with('success', "Kiosk Deleted Successfully!");
    }
}
