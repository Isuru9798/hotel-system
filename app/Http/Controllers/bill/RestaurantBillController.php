<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantBillController extends Controller
{
    function index()
    {
        $rooms = Rooms::all();
        $restaurant_bills = DB::table('orders')
            ->select(
                'orders.id as orders_id',
                'items.itm_img',
                'items.itm_description',
                'items.itm_item_code',
                'items.itm_item_name',
                'orders.or_tot',
                'orders.or_quantity',
                'orders.or_status',
                'rooms.rm_type',
                'rooms.rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'orders.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->join('items', 'items.id', 'orders.items_id')
            ->get();
        return view('bill.restaurant_bill', ['restaurant_bills' => $restaurant_bills, 'rooms' => $rooms]);
    }
    function cancel($id)
    {
        Orders::where('id', $id)
            ->update([
                'or_status' => env('CANCELED'),
            ]);
        return redirect()->route('restaurant-bills');
    }
}
