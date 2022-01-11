<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantBillController extends Controller
{
    function index()
    {
        $rooms = Rooms::all();
        $taxi_bills = DB::table('orders')
            // ->select(
            //     'taxis.id as taxi_id',
            //     'taxis.tx_destination',
            //     'taxis.tx_vehicle_num',
            //     'taxis.tx_status',
            //     'taxis.tx_amount',
            //     'taxis.tx_tax',
            //     'taxis.tx_num_of_days',
            //     'taxis.tx_issue_date',
            //     'rooms.rm_type',
            //     'rooms.rm_number',
            // )
            ->join('checked_rooms', 'checked_rooms.id', 'orders.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->join('items', 'items.id', 'orders.items_id')
            ->get();
        dd($taxi_bills);
        return view('bill.restaurant_bill', ['taxi_bills' => $taxi_bills, 'rooms' => $rooms]);
    }
}
