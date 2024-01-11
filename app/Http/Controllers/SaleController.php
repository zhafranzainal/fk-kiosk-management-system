<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\KioskParticipant;
use App\Models\Kiosk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any', Sale::class);

        $user = User::All();
        $kiosk_participant = KioskParticipant::All();
        $totalMonthlyRevenue = Sale::whereMonth('created_at', now()->month)->sum('monthly_revenue');
        $totalProfit = Sale::sum('profit');
        $totalRevenue = Sale::sum('monthly_revenue');

        // for graph pupuk admin
        $monthlyData = Sale::whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as label, sum(monthly_revenue) as revenue')
            ->groupBy('label')
            ->get();

        $yearlyData = Sale::whereYear('created_at', now()->year)
            ->selectRaw('YEAR(created_at) as label, sum(monthly_revenue) as revenue')
            ->groupBy('label')
            ->get();


        if (auth()->user()->getRoleNames()->contains('Kiosk Participant')) {
            // calculate total monthly revenue
            $totalMonthlyRevenue = Sale::whereHas('kioskParticipant', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->whereMonth('created_at', now()->month)->sum('monthly_revenue');

            // calculate total profit
            $totalProfit = Sale::whereHas('kioskParticipant', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->sum('profit');

            // calculate total revenue
            $totalRevenue = Sale::whereHas('kioskParticipant', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->sum('monthly_revenue');

            // In your controller
            $monthlyData = Sale::whereHas('kioskParticipant', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
                ->whereYear('created_at', now()->year)
                ->selectRaw('MONTH(created_at) as month, sum(monthly_revenue) as revenue')
                ->groupBy('month')
                ->get();

            //call table kioskParticipant
            $sales = Sale::whereHas('kioskParticipant', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->paginate(15);
            return view('sales.index', compact('sales', 'totalMonthlyRevenue', 'totalProfit', 'totalRevenue', 'kiosk_participant', 'monthlyData'));
        }

        return view('sales.index', compact('totalMonthlyRevenue', 'totalProfit', 'totalRevenue', 'user', 'kiosk_participant', 'monthlyData', 'yearlyData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kiosk_participant = KioskParticipant::where('user_id', auth()->user()->id)->first();
        return view('sales.create', compact('kiosk_participant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $kiosk_participant = KioskParticipant::find($request->input('kiosk_participant_id'));
        $monthly_revenue = $request->input('monthly_revenue');
        // Assuming you want to update the status based on the condition
        if ($monthly_revenue < 500) {
            $kiosk_participant->kiosk->update(['status' => 'Warning']);
        } else {
            $kiosk_participant->kiosk->update(['status' => 'Active']);
        }

        // update status
        $status = ($monthly_revenue < 500) ? 'Warning' : 'Active';

        $request->merge([
            'kiosk_participant_id' => $kiosk_participant->id,
            'kiosk_id' => $kiosk_participant->kiosk_id,
            'user_id' => auth()->user()->id,
            'status' => $status,
        ]);

        // dd($request->all());
        Sale::create($request->all());

        return redirect()->route('sales.index')->with('success', "Sales Successfully Insert!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $kiosk_participant = KioskParticipant::where('user_id', auth()->user()->id)->first();
        return view('sales.show', compact('sale', 'kiosk_participant'));
    }

    public function showPupuk($id)
    {

        $kioskParticipant = KioskParticipant::where('user_id', $id)->first();

        $sale = Sale::where('kiosk_participant_id', $kioskParticipant->id)->get();

        $totalRevenue = $sale->sum('monthly_revenue');
        $totalProfit = $sale->sum('profit');

        $monthlyData = Sale::where('kiosk_participant_id', $kioskParticipant->id)
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as label, sum(monthly_revenue) as revenue')
            ->groupBy('label')
            ->get();
            // dd($sale);

        
        return view('sales.show', compact('kioskParticipant', 'sale','totalRevenue', 'totalProfit','monthlyData'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $sale = Sale::find($id);
        // $kiosk_participant = KioskParticipant::where('user_id', auth()->user()->id)->first();
        return view('sales.index', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        // $kiosk_participant = KioskParticipant::find($request->input('kiosk_participant_id'));
        // $kiosk = KioskParticipant::find($kiosk_participant->kiosk_id);
        $monthly_revenue = $request->input('monthly_revenue');
        $status = ($monthly_revenue < 500) ? 'Warning' : 'Active';
        $sale->update([
            'monthly_revenue' => $request->monthly_revenue,
            'profit' => $request->profit,
            'cost_of_goods_sold' => $request->cost_of_goods_sold,
            'status' => $status,
        ]);;

        $current_kiosk = $sale->status;

        if ($current_kiosk == 'Warning') {

            $sale->kioskParticipant->kiosk->update(['status' => 'Active']);
        } else {
            $sale->kioskParticipant->kiosk->update(['status' => 'Warning']);
        }

        return redirect()->route('sales.index')->with('success', "Sales Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updatePupuk(Request $request, $id)
    {
        $kioskParticipant = KioskParticipant::find($id);
        // $kioskParticipant = KioskParticipant::where('user_id', $id)->first();

        $kiosk = Kiosk::where('id', $kioskParticipant->kiosk_id)->first();
        $kiosk->comment = $request->input('comment');
    
        // Save the changes
        $kiosk->save();
    
        // You can redirect or return a response as needed
        return redirect()->route('sales.index')->with('success', 'Comment updated successfully');
    }
}
