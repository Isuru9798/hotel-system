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
        $guest = DB::table('guests')
            ->select(
                'guests.id as guest_id',
                'guests.gs_name  as gs_name',
            )
            ->join('check_ins', 'check_ins.guests_id', 'guests.id')
            ->join('checked_rooms', 'checked_rooms.check_ins_id', 'check_ins.id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->first();

        $roomBills =  DB::table('room_bills')
            ->select(
                'room_bills.id as rooms_bill_id',
                'room_bills.rb_issue_date as rb_issue_date',
                'room_bills.rb_doller_rate as rb_doller_rate',
                'room_bills.rb_amount_doller as rb_amount_doller',
                'room_bills.rb_status as rb_status',
                'room_bills.rb_cost as rb_cost',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('room_bills.rb_status', env('UNPAID'))
            ->get();
        $taxis =  DB::table('taxis')
            ->select(
                'taxis.id as taxis_id',
                'taxis.tx_destination as tx_destination',
                'taxis.tx_vehicle_num as tx_vehicle_num',
                'taxis.tx_status as tx_status',
                'taxis.tx_num_of_days as tx_num_of_days',
                'taxis.tx_issue_date as tx_issue_date',
                'taxis.tx_amount as tx_amount',
                'taxis.tx_tax as tx_tax',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'taxis.checked_rooms_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('taxis.tx_status', env('UNPAID'))
            ->get();
        $laundries =  DB::table('laundries')
            ->select(
                'laundries.id as laundries_id',
                'laundries.lon_issue_date as lon_issue_date',
                'laundries.lon_status as lon_status',
                'laundries.lon_item as lon_item',
                'laundries.lon_amount as lon_amount',
                'laundries.lon_quantity as lon_quantity',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'laundries.checked_rooms_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('laundries.lon_status', env('UNPAID'))
            ->get();
        $restaurant =  DB::table('orders')
            ->select(
                'orders.id as orders_id',
                'orders.or_quantity as or_quantity',
                'orders.or_status as or_status',
                'orders.or_tot as or_tot',
                'orders.or_service_chrge as or_service_chrge',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'orders.checked_rooms_id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('orders.or_status', env('UNPAID'))
            ->get();
        return response()->json(
            [
                'room_bills' => $roomBills,
                'taxi_bills' => $taxis,
                'laundry_bills' => $laundries,
                'restaurant_bills' => $restaurant,
                'guest' => $guest
            ]
        );
    }
}
