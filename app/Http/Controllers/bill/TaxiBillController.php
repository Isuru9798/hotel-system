<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use App\Models\Taxis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxiBillController extends Controller
{
    function index()
    {
        $rooms = Rooms::all();
        $taxi_bills = DB::table('taxis')
            ->select(
                'taxis.id as taxi_id',
                'taxis.tx_destination',
                'taxis.tx_vehicle_num',
                'taxis.tx_status',
                'taxis.tx_amount',
                'taxis.tx_tax',
                'taxis.tx_num_of_days',
                'taxis.tx_issue_date',
                'rooms.rm_type',
                'rooms.rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'taxis.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->get();
        return view('bill.taxi_bill', ['taxi_bills' => $taxi_bills, 'rooms' => $rooms]);
    }

    function store(Request $request)
    {
        Taxis::create([
            'tx_destination' => $request->tx_destination,
            'tx_vehicle_num' => $request->tx_vehicle_num,
            'tx_status' => env('UNPAID'),
            'tx_num_of_days' => $request->tx_num_of_days,
            'tx_issue_date' => date('Y-m-d', strtotime($request->tx_issue_date)),
            'tx_amount' => $request->tx_amount,
            'tx_tax' => $request->tx_tax,
            'checked_rooms_id' => $request->checked_rooms_id,
        ]);
        return redirect()->route('taxi-bills');
    }
    function cancel($id)
    {
        Taxis::where('id', $id)
            ->update([
                'tx_status' => env('CANCELED'),
            ]);
        return redirect()->route('taxi-bills');
    }
}
