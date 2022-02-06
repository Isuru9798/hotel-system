<?php

namespace App\Http\Controllers\checkOut;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
        $checkin = DB::table('check_ins')
            ->select(
                'check_ins.id as check_ins_id'
            )
            ->join('checked_rooms', 'checked_rooms.check_ins_id', 'check_ins.id')
            ->where('checked_rooms.rooms_id', $request->id)
            ->where('check_ins.ci_status', env('UNPAID'))
            ->first();

        $guest = DB::table('guests')
            ->select(
                'guests.id as guest_id',
                'guests.gs_name as gs_name',
                'guests.gs_passport_or_id as gs_passport_or_id',
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

        if ($checkin == null) {
            $checkin = false;
        }

        return response()->json(
            [
                'room_bills' => $roomBills,
                'taxi_bills' => $taxis,
                'laundry_bills' => $laundries,
                'restaurant_bills' => $restaurant,
                'guest' => $guest,
                'checkin' => $checkin
            ]
        );
    }



    function checkout(Request $request)
    {
        function barcodeNumberExists($number)
        {
            // query the database and return a boolean
            // for instance, it might look like this in Laravel
            return Bill::where('invoice_num', $number)->exists();
        }

        function generateBarcodeNumber()
        {
            $number = mt_rand(10000, 99999); // better than rand()

            // call the same function if the barcode exists already
            if (barcodeNumberExists($number)) {
                return generateBarcodeNumber();
            }

            // otherwise, it's valid and can be used
            return 'INV_' . $number;
        }
        $in_code = generateBarcodeNumber();
        $messages = [
            'required' => 'something wrong please check again and submit',
        ];
        $validateData = $request->validate(
            [
                'checkin_id' => 'required',
            ],
            $messages
        );



        DB::table('room_bills')
            ->join('checked_rooms', 'checked_rooms.id', 'room_bills.checked_rooms_id')
            ->where('checked_rooms.check_ins_id', $request->checkin_id)
            ->where('checked_rooms.rooms_id', $request->room_id)
            ->where('room_bills.rb_status', env('UNPAID'))
            ->update([
                'room_bills.rb_status' => env('PAID')
            ]);


        DB::table('taxis')
            ->join('checked_rooms', 'checked_rooms.id', 'taxis.checked_rooms_id')
            ->where('checked_rooms.check_ins_id', $request->checkin_id)
            ->where('checked_rooms.rooms_id', $request->room_id)
            ->where('taxis.tx_status', env('UNPAID'))
            ->update([
                'taxis.tx_status' => env('PAID')
            ]);

        DB::table('laundries')
            ->join('checked_rooms', 'checked_rooms.id', 'laundries.checked_rooms_id')
            ->where('checked_rooms.check_ins_id', $request->checkin_id)
            ->where('checked_rooms.rooms_id', $request->room_id)
            ->where('laundries.lon_status', env('UNPAID'))
            ->update([
                'laundries.lon_status' => env('PAID')
            ]);

        DB::table('orders')
            ->join('checked_rooms', 'checked_rooms.id', 'orders.checked_rooms_id')
            ->where('checked_rooms.check_ins_id', $request->checkin_id)
            ->where('checked_rooms.rooms_id', $request->room_id)
            ->where('orders.or_status', env('UNPAID'))
            ->update([
                'orders.or_status' => env('PAID')
            ]);


        DB::table('rooms')
            ->where('id', $request->room_id)
            ->update([
                'rm_availability' => env('AVAILABLE')
            ]);


        DB::table('checked_rooms')
            ->where('status', env('UNPAID'))
            ->where('check_ins_id', $request->checkin_id)
            ->where('checked_rooms.rooms_id', $request->room_id)
            ->update([
                'status' => env('PAID')
            ]);

        $checkins = DB::table('checked_rooms')
            ->where('status', env('UNPAID'))
            ->where('check_ins_id', $request->checkin_id)
            ->get();

        $checkedRoom = DB::table('checked_rooms')
            ->where('rooms_id', $request->room_id)
            ->where('check_ins_id', $request->checkin_id)
            ->first();

        if (count($checkins) == 0) {
            DB::table('check_ins')
                ->where('ci_status', env('UNPAID'))
                ->where('id', $request->checkin_id)
                ->update([
                    'ci_status' => env('PAID')
                ]);

            $checkout = CheckOut::create([
                'date' => Date::now(),
                'status' => env('PAID'),
                'checked_rooms_id' =>  $checkedRoom->id
            ]);
        }

        // dd($checkedRoom);

        $bill =  Bill::create([
            'date' => Date::now(),
            'bill_tot' =>  $request->bill_tot,
            'invoice_num' =>  $in_code,
            'status' => env('PAID'),
            'guests_id' =>  $request->guest_id,
            'checked_rooms_id' =>  $checkedRoom->id
        ]);



        return redirect()->back()->with('bill_id', $bill->id);
    }

}
