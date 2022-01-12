<?php

namespace App\Http\Controllers\checkOut;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    function index()
    {
        $rooms = Rooms::where('rm_availability', env('UNAVAILABLE'))->get();
        return view('check-out.check-out', ['rooms' => $rooms]);
    }

    function getBills(Request $request)
    {
        $roomBills =  DB::table('room_bills')
            // ->select(
            //     'checked_rooms.id as checked_rooms_id',
            //     'guests.gs_name as gs_name'
            // )
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('room_bills.rb_status', env('UNPAID'))
            ->get();
        return response()->json($roomBills);
    }
}
