<?php

namespace App\Http\Controllers\QR;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Rooms;
use Illuminate\Http\Request;

class QRController extends Controller
{
    function index($id)
    {
        if (Rooms::find($id)) {
            $items  = Items::all();
            return view('qr.item-list', ['items' => $items, 'roomId' => $id]);
        } else {
            return view('qr.404');
        }
    }
    function placeOrder(Request $request)
    {
        # code...
    }
}
