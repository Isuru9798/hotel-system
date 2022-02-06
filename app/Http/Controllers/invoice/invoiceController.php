<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class invoiceController extends Controller
{
    function index()
    {
        $bills = Bill::all();
        return view('invoice.invoice', ['bills' => $bills]);
    }
    function invoice($id)
    {

        $bill = DB::table('bills')
            ->select(
                'bills.id as bill_id',
                'bills.date as bill_date',
                'bills.bill_tot as bill_tot',
                'bills.invoice_num as invoice_num',
                'bills.status as bill_status',
                'bills.guests_id as guests_id',
                'checked_rooms.id as checked_rooms_id',
                'checked_rooms.check_ins_id as check_ins_id',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'bills.checked_rooms_id')
            ->where('bills.id', $id)
            ->first();

        // $checkin = DB::table('check_ins')
        //     ->select(
        //         'check_ins.id as check_ins_id'
        //     )
        //     ->join('checked_rooms', 'checked_rooms.check_ins_id', 'check_ins.id')
        //     ->where('checked_rooms.check_ins_id', $bill->check_ins_id)
        //     ->where('checked_rooms.ci_status', env('PAID'))
        //     ->first();

        $guest = DB::table('guests')
            ->where('guests.id', $bill->guests_id)
            ->first();

        $roomBills =  DB::table('room_bills')
            ->select(
                'room_bills.id as rooms_bill_id',
                'room_bills.rb_issue_date as rb_issue_date',
                'room_bills.rb_doller_rate as rb_doller_rate',
                'room_bills.rb_amount_doller as rb_amount_doller',
                'room_bills.rb_status as rb_status',
                'room_bills.rb_cost as rb_cost',
                'rooms.rm_number as rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->where('checked_rooms.check_ins_id', $bill->check_ins_id)
            ->where('room_bills.rb_status', env('PAID'))
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
                'rooms.rm_number as rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'taxis.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->where('checked_rooms.check_ins_id', $bill->check_ins_id)
            ->where('taxis.tx_status', env('PAID'))
            ->get();
        $laundries =  DB::table('laundries')
            ->select(
                'laundries.id as laundries_id',
                'laundries.lon_issue_date as lon_issue_date',
                'laundries.lon_status as lon_status',
                'laundries.lon_item as lon_item',
                'laundries.lon_amount as lon_amount',
                'laundries.lon_quantity as lon_quantity',
                'rooms.rm_number as rm_number',
            )
            ->join('checked_rooms', 'checked_rooms.id', 'laundries.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->where('checked_rooms.check_ins_id', $bill->check_ins_id)
            ->where('laundries.lon_status', env('PAID'))
            ->get();
        $restaurant =  DB::table('orders')
            ->select(
                'orders.id as orders_id',
                'orders.or_quantity as or_quantity',
                'orders.or_status as or_status',
                'orders.or_tot as or_tot',
                'orders.or_service_chrge as or_service_chrge',
                'rooms.rm_number as rm_number',
                'items.itm_item_name as itm_item_name',
                'items.itm_item_code as itm_item_code'
            )
            ->join('checked_rooms', 'checked_rooms.id', 'orders.checked_rooms_id')
            ->join('rooms', 'rooms.id', 'checked_rooms.rooms_id')
            ->join('items', 'items.id', 'orders.items_id')
            ->where('checked_rooms.check_ins_id', $bill->check_ins_id)
            ->where('orders.or_status', env('PAID'))
            ->get();

        // if ($checkin == null) {
        //     $checkin = false;
        // }
        // dd([
        //     'bill' => $bill,
        //     // 'checkin' => $checkin,
        //     'room_bills' => $roomBills,
        //     // 'taxi_bills' => $taxis,
        //     // 'laundry_bills' => $laundries,
        //     // 'restaurant_bills' => $restaurant,
        //     'guest' => $guest,
        // ]);

        // return response()->json();




        return view('invoice.invoice-view', [
            'bill' => $bill,
            // 'checkin' => $checkin,
            'room_bills' => $roomBills,
            'taxi_bills' => $taxis,
            'laundry_bills' => $laundries,
            'restaurant_bills' => $restaurant,
            'guest' => $guest,
        ]);
    }
}
