<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
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
                'taxis.tx_num_of_days',
                'taxis.tx_issue_date',
                'rooms.rm_type',
                'rooms.rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->get();
        return view('bill.taxi_bill', ['taxi_bills' => $taxi_bills, 'rooms' => $rooms]);
    }
    // function getDataByRoom(Request $request)
    // {
    //     $roomData =  DB::table('checked_rooms')
    //         ->select(
    //             'checked_rooms.id as checked_rooms_id',
    //             'guests.gs_name as gs_name'
    //         )
    //         ->join('check_ins', 'check_ins.id', 'checked_rooms.check_ins_id')
    //         ->join('guests', 'guests.id', 'check_ins.guests_id')
    //         ->where('checked_rooms.rooms_id', $request->id)
    //         ->first();
    //     return response()->json($roomData);
    // }
    // function store(Request $request)
    // {
    //     RoomBills::create([
    //         'rb_issue_date' => date('Y-m-d', strtotime($request->rb_issue_date)),
    //         'rb_doller_rate' => $request->rb_doller_rate,
    //         'rb_amount_doller' => $request->rb_amount_doller,
    //         'rb_cost' => $request->rb_cost,
    //         'rb_status' => env('UNPAID'),
    //         'checked_rooms_id' => $request->checked_rooms_id,
    //     ]);
    //     return redirect()->route('room-bills');
    // }
    // function cancel($id)
    // {
    //     RoomBills::where('id', $id)
    //         ->update([
    //             'rb_status' => env('CANCELED'),
    //         ]);
    //     return redirect()->route('room-bills');
    // }
}
