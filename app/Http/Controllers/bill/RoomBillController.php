<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\RoomBills;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomBillController extends Controller
{
    function index()
    {
        $rooms = Rooms::where('rm_availability', env('UNAVAILABLE'))->get();
        $room_bills = DB::table('room_bills')
            ->select(
                'room_bills.id as room_bill_id',
                'room_bills.rb_issue_date',
                'room_bills.rb_doller_rate',
                'room_bills.rb_amount_doller',
                'room_bills.rb_cost',
                'room_bills.rb_status',
                'rooms.rm_type',
                'rooms.rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->get();
        return view('bill.room_bill', ['room_bills' => $room_bills, 'rooms' => $rooms]);
    }
    function getDataByRoom(Request $request)
    {
        $roomData =  DB::table('checked_rooms')
            ->select(
                'checked_rooms.id as checked_rooms_id',
                'guests.gs_name as gs_name'
            )
            ->join('check_ins', 'check_ins.id', 'checked_rooms.check_ins_id')
            ->join('guests', 'guests.id', 'check_ins.guests_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->first();
        return response()->json($roomData);
    }
    function store(Request $request)
    {
        $messages = [
            'required' => 'This Field is required',
        ];
        $validateData = $request->validate(
            [
                'rb_issue_date' => 'required|string',
                'rb_doller_rate' => 'required|numeric',
                'rb_amount_doller' => 'required|numeric',
                'rb_cost' => 'required|numeric',
                'checked_rooms_id' => 'required|numeric',
            ],
            $messages
        );

        RoomBills::create([
            'rb_issue_date' => date('Y-m-d', strtotime($request->rb_issue_date)),
            'rb_doller_rate' => $request->rb_doller_rate,
            'rb_amount_doller' => $request->rb_amount_doller,
            'rb_cost' => $request->rb_cost,
            'rb_status' => env('UNPAID'),
            'checked_rooms_id' => $request->checked_rooms_id,
        ]);
        return redirect()->route('room-bills');
    }
    function cancel($id)
    {
        RoomBills::where('id', $id)
            ->update([
                'rb_status' => env('CANCELED'),
            ]);
        return redirect()->route('room-bills');
    }
}
