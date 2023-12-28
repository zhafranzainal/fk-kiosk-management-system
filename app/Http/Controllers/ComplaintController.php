<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\KioskParticipant;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->getRoleNames()->contains('Kiosk Participant')) {
            $complaints = Complaint::where('user_id', auth()->user()->id)->paginate(10);
        }else if(auth()->user()->getRoleNames()->contains('Technical Team')){
            $complaints = Complaint::all();
        }
        //$this->authorize('view-any', Complaint::class);
        
        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', auth()->user()->id)->first();
        $kiosks = KioskParticipant::where('user_id', auth()->user()->id)->first();
        return view('complaints.create', compact('users', 'kiosks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kiosk_participant = KioskParticipant::find($request->input('kiosk_participant_id'));

        $request->merge([
            'kiosk_participant_id' => $kiosk_participant->id,
            'user_id' => auth()->user()->id,
        ]);

        Complaint::create($request->all());
        return redirect()->route('complaints.index')->with('success', "Complaint Inserted Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $complaint = Complaint::find($id);
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $complaint = Complaint::find($id);
        return view('complaints.update', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $complaint = Complaint::find($id);
        $complaint->description = $request->input('description');
        $complaint->save();
        return redirect()->route('complaints.index')
            ->with('success', "Complaint Updated Successfully!");
    }

    public function assignTo(Request $request, $id)
    {
        $complaint = Complaint::find($id);
        $complaint->assign_to = $request->input('assign_to');
        $complaint->status = "In Progress";
        $complaint->save();
        return redirect()->route('complaints.index')
            ->with('success', "Assigned To Updated Successfully!");
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::find($id);
        if (auth()->user()->getRoleNames()->contains('Kiosk Participant')) {
            $complaint->status = "Closed";
        }else if(auth()->user()->getRoleNames()->contains('Technical Team')){
            $complaint->status = "Completed";
        }
    
        $complaint->save();
        return redirect()->route('complaints.index')
            ->with('success', "Complaint Status Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $complaint = Complaint::find($id);
        $complaint ->delete($complaint);
        return redirect()->route('complaints.index')
            ->with('success', "Complaint Deleted Successfully!");
    }
}
