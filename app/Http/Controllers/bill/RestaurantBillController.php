<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Orders;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantBillController extends Controller
{
    function index()
    {
        $items = Items::all();
        $rooms = Rooms::all();
        $restaurant_bills = DB::table('orders')
            ->select(
                'orders.id as orders_id',
                'items.itm_img',
                'items.itm_description',
                'items.itm_item_code',
                'items.itm_item_name',
                'items.itm_item_price',
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
        return view('bill.restaurant_bill', ['restaurant_bills' => $restaurant_bills, 'rooms' => $rooms, 'items' => $items]);
    }
    function store(Request $request)
    {
        $messages = [
            'required' => 'This Field is required',
        ];
        $validateData = $request->validate(
            [
                'or_quantity' => 'required|numeric',
                'or_service_chrge' => 'required|numeric',
            ],
            $messages
        );

        Orders::create([
            'or_quantity' => $request->or_quantity,
            'or_status' => env('UNPAID'),
            'or_tot' => $request->or_tot,
            'or_service_chrge' => $request->or_service_chrge,
            'checked_rooms_id' => $request->checked_rooms_id,
            'items_id' => $request->items_id,
        ]);
        return redirect()->route('restaurant-bills');
    }
    function cancel($id)
    {
        Orders::where('id', $id)
            ->update([
                'or_status' => env('CANCELED'),
            ]);
        return redirect()->route('restaurant-bills');
    }
    function getItemData(Request $request)
    {
        $roomData =  DB::table('items')
            ->where('id', $request->id)
            ->first();
        return response()->json($roomData);
    }
}
