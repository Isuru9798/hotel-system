<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Models\Laundries;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaundryBillController extends Controller
{
    function index()
    {
        $rooms = Rooms::all();
        $laundry_bills = DB::table('laundries')
            ->select(
                'laundries.id as laundry_id',
                'laundries.lon_issue_date',
                'laundries.lon_status',
                'laundries.lon_item',
                'laundries.lon_amount',
                'laundries.lon_quantity',
                'rooms.rm_type',
                'rooms.rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'laundries.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->get();
        return view('bill.laundry_bill', ['laundry_bills' => $laundry_bills, 'rooms' => $rooms]);
    }

    function store(Request $request)
    {
        $messages = [
            'required' => 'This Field is required',
        ];
        $validateData = $request->validate(
            [
                'lon_issue_date' => 'required|string',
                'lon_item' => 'required|string',
                'lon_amount' => 'required|numeric',
                'lon_quantity' => 'required|numeric',
            ],
            $messages
        );

        Laundries::create([
            'lon_issue_date' => date('Y-m-d', strtotime($request->lon_issue_date)),
            'lon_status' => env('UNPAID'),
            'lon_item' =>  $request->lon_item,
            'lon_amount' => $request->lon_amount,
            'lon_quantity' => $request->lon_quantity,
            'checked_rooms_id' => $request->checked_rooms_id,
        ]);
        return redirect()->route('laundry-bills');
    }
    function cancel($id)
    {
        Laundries::where('id', $id)
            ->update([
                'lon_status' => env('CANCELED'),
            ]);
        return redirect()->route('laundry-bills');
    }
}
