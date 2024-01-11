<?php

namespace App\Http\Controllers;

use App\Models\Kiosk;
use App\Models\Application;
use App\Models\Transaction;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Application::class);

        $applications = Application::All();
        $kiosks = Kiosk::all();
        $user = Auth::user();
        $businesses = BusinessType::all();

        if (auth()->user()->hasRole('Kiosk Participant')) {
            $applications = Application::where('user_id', auth()->user()->id)->get();
        }
        return view('applications.index', compact('applications', 'kiosks', 'user', 'businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kiosks = Kiosk::all();
        $user = Auth::user();
        $businesses = BusinessType::all();

        return view('applications.create', compact('kiosks', 'user', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'string',
                'course' => 'string',
                'year' => 'numeric',
                'semester' => 'numeric',
                'contact_num' => 'required|string',
                'kioskNumber' => 'required|numeric',
                'start_date' => 'required',
                'end_date' => 'required',
                'businessType' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $application = new Application();

        // Assign values from the form to the application instance
        $application->kiosk_id = $request->input('kioskNumber');
        $application->user_id = auth()->user()->id;
        $application->start_date = $request->input('start_date');
        $application->end_date = $request->input('end_date');
        $application->status = 'Pending';

        // create a new transaction during submit application
        $transaction = new Transaction([
            'user_id' => auth()->user()->id,
            'amount' => 200.00, // Replace with the actual amount value
            'status' => 'Pending', // You can set the initial status as needed
        ]);

        $transaction->save();

        $application->transaction()->associate($transaction);
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application = Application::findOrFail($application->id);

        $kiosks = Kiosk::all();
        $user = Auth::user();
        $businesses = BusinessType::all();

        return view('applications.show', compact('application', 'kiosks', 'user', 'businesses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $application = Application::find($application->id);
        // return response()->json($application);
        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        // check if the application status 'Approved' or 'Rejected', if yes restrict their action
        if ($application->status == 'Approved' || $application->status == 'Rejected') {
            return redirect()->back()->with('error', 'You\'re not allowed to update after application Approved or Rejected!');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'course' => 'string',
                'year' => 'numeric',
                'semester' => 'numeric',
                'contact_num' => 'required|string',
                'kioskNumber' => 'required|numeric',
                'start_date' => 'required',
                'end_date' => 'required',
                'businessType' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Assign values from the form to the application instance
        $application->kiosk_id = $request->input('kioskNumber');
        $application->start_date = $request->input('start_date');
        $application->end_date = $request->input('end_date');
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        // check if the application status 'Approved' or 'Rejected', if yes restrict their action
        if ($application->status == 'Approved' || $application->status == 'Rejected') {
            return redirect()->back()->with('error', 'You\'re not allowed to remove after application Approved or Rejected!');
        }

        $application->delete();
        $application->transaction()->delete();
        return redirect()->route('applications.index')->with('success', 'You have deleted application successfully');
    }

    /**
     * Update the status
     */
    public function updateStatus(Request $request, Application $application)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'reason' => 'required_if:status,Rejected|max:255',
        ]);

        // Update the application status
        $application->status = $request->input('status');

        if ($request->input('status') === 'Rejected') {
            $application->reason = $request->input('reason');
        }

        if ($request->input('status') === 'Approved') {
            $application->kiosk->status = 'Active';
            $application->kiosk->save();
        }

        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application status updated');
    }
}
