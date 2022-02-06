<?php

namespace App\Http\Controllers\checkIn;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\CheckedRooms;
use App\Models\CheckIn;
use App\Models\Guests;
use App\Models\Rooms;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    function index()
    {
        $check_ins = CheckIn::get();
        $guests = Guests::all();
        $checked_rooms = CheckedRooms::all();
        $rooms = Rooms::all();

        $checkins = [];

        foreach ($check_ins as $key => $check_in) {
            $checkins[$check_in->id] = [
                'ci_id' => $check_in->id,
                'ci_in_date' => $check_in->ci_in_date,
                'ci_out_date' => $check_in->ci_out_date,
                'ci_nights' => $check_in->ci_nights,
                'ci_adults' => $check_in->ci_adults,
                'ci_child' => $check_in->ci_child,
                'ci_status' => $check_in->ci_status
            ];

            foreach ($guests as $key => $guest) {
                if ($guest['id'] == $check_in['guests_id']) {
                    $checkins[$check_in->id]['guest'] = [
                        'gs_id' => $guest->id,
                        'gs_name' => $guest->gs_name,
                        'gs_address' => $guest->gs_address,
                        'gs_gender' => $guest->gs_gender,
                        'gs_passport_or_id' => $guest->gs_passport_or_id,
                        'gs_mobile' => $guest->gs_mobile,
                        'gs_country' => $guest->gs_country
                    ];
                }
            }

            // $checkedRooms = [];
            $checkins[$check_in->id]['checked_rooms'] = [];
            foreach ($checked_rooms as $key => $checked_room) {

                if ($checked_room['check_ins_id'] == $check_in['id']) {
                    $room = $rooms->find($checked_room['rooms_id']);
                    array_push($checkins[$check_in->id]['checked_rooms'], [
                        'checked_status' => $checked_room['status'],
                        'rm_number' => $room->rm_number,
                        'rm_type' => $room->rm_type,
                        'rm_availability' => $room->rm_availability,
                    ]);
                }
            }
        }
        return view('check-in.check-in', ['checkIns' => $checkins, 'rooms' => $rooms]);
    }
    function store(Request $request)
    {

        $messages = [
            'required' => 'This Field is required',
        ];
        $validateData = $request->validate(
            [
                'gs_name' => 'required|string',
                'gs_address' => 'required|string',
                'gs_gender' => 'required|string',
                'gs_passport_or_id' => 'required|string',
                'gs_mobile' => 'required|string',
                'gs_country' => 'required|string',
                'ci_in_date' => 'required|string',
                'ci_out_date' => 'required|string',
                'ci_nights' => 'required|numeric',
                'ci_adults' => 'required|numeric',
                'ci_child' => 'required|numeric',
            ],
            $messages
        );
        if (count(json_decode($request->selectedRooms)) == 0) {
            return redirect()->route('checkIn')->with('room_select', 'Please Select the room');
        }
        if ($request->guest_status == 0) {
            $guest = Guests::create([
                'gs_name' => $request->gs_name,
                'gs_address' => $request->gs_address,
                'gs_gender' => $request->gs_gender,
                'gs_passport_or_id' => $request->gs_passport_or_id,
                'gs_mobile' => $request->gs_mobile,
                'gs_country' => $request->gs_country,
            ])->id;
        } else {
            $guest = $request->guest_id;
        }
        $checkIn = CheckIn::create([
            'ci_in_date' => date('Y-m-d', strtotime($request->ci_in_date)),
            'ci_out_date' =>  date('Y-m-d', strtotime($request->ci_out_date)),
            'ci_nights' => $request->ci_nights,
            'ci_adults' => $request->ci_adults,
            'ci_child' => $request->ci_child,
            'ci_status' => env('UNPAID'),
            'guests_id' => $guest,
        ])->id;

        $checkedRooms = json_decode($request->selectedRooms);
        foreach ($checkedRooms as $key => $value) {
            Rooms::where('id', $value)
                ->update([
                    'rm_availability' => env('UNAVAILABLE'),
                ]);
            CheckedRooms::create([
                'status' => env('UNPAID'),
                'rooms_id' => $value,
                'check_ins_id' => $checkIn,
            ]);
        }
        return redirect()->route('checkIn');
    }
    function getById($id)
    {
        $check_in = CheckIn::find($id);
        $guest = Guests::find($check_in->guests_id);
        $checked_rooms = CheckedRooms::all();
        $rooms = Rooms::all();

        $checkin = [];


        $checkin = [
            'ci_id' => $check_in->id,
            'ci_in_date' => $check_in->ci_in_date,
            'ci_out_date' => $check_in->ci_out_date,
            'ci_nights' => $check_in->ci_nights,
            'ci_adults' => $check_in->ci_adults,
            'ci_child' => $check_in->ci_child,
            'ci_status' => $check_in->ci_status
        ];
        $checkin['guest'] = [
            'gs_id' => $guest->id,
            'gs_name' => $guest->gs_name,
            'gs_address' => $guest->gs_address,
            'gs_gender' => $guest->gs_gender,
            'gs_passport_or_id' => $guest->gs_passport_or_id,
            'gs_mobile' => $guest->gs_mobile,
            'gs_country' => $guest->gs_country
        ];


        // $checkedRooms = [];
        $checkin['checked_rooms'] = [];

        foreach ($checked_rooms as $key => $checked_room) {

            if ($checked_room['check_ins_id'] == $check_in['id']) {
                $room = $rooms->find($checked_room['rooms_id']);
                array_push($checkin['checked_rooms'], [
                    'checked_status' => $checked_room['status'],
                    'rm_number' => $room->rm_number,
                    'rm_type' => $room->rm_type,
                    'rm_availability' => $room->rm_availability,
                ]);
            }
        }
        return view('check-in.view-check-in', ['checkin' => $checkin]);
    }
    function cancelCheckIn($id)
    {

        CheckIn::where('id', $id)
            ->update([
                'ci_status' => env('CANCELED'),
            ]);
        return redirect()->route('checkIn');
    }
    // function deleteRoom($id)
    // {
    //     Items::destroy($id);
    //     $items = Items::all();
    //     return view('items.items', ['items' => $items]);
    // }
    function findGuest(Request $request)
    {
        $guest = Guests::where('gs_passport_or_id', $request->gs_passport_or_id)->first();
        if (Guests::where('gs_passport_or_id', $request->gs_passport_or_id)->exists()) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(
            [
                'status' => $status,
                'guest' => $guest,
            ]
        );
    }
}
