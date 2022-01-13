<?php

namespace App\Http\Controllers\rooms;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    function index()
    {
        $rooms = Rooms::all();
        return view('rooms.rooms', ['rooms' => $rooms]);
    }
    function store(Request $request)
    {
        $messages = [
            'required' => 'This Field is required',
        ];
        $validateData = $request->validate(
            [
                'rm_number' => 'required|string',
                'rm_type' => 'required|string',
            ],
            $messages
        );

        Rooms::create([
            'rm_number' => $request->rm_number,
            'rm_type' => $request->rm_type,
            'rm_availability' => env('AVAILABLE'),
        ]);
        return redirect()->route('rooms');
    }
    function getById($id)
    {
        $room = Rooms::find($id);
        return view('rooms.rooms', ['room' => $room]);
    }
    function update(Request $request)
    {
        Rooms::where('id', $request->id)
            ->update([
                'rm_number' => $request->rm_number,
                'rm_type' => $request->rm_type,
                'rm_availability' => $request->rm_availability,
            ]);
        return redirect()->route('rooms');
    }
    function delete($id)
    {
        Rooms::destroy($id);
        return redirect()->route('rooms');
    }
}
