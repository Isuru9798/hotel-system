<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    function index()
    {
        $items = Items::all();
        return view('restaurant.restaurant', ['items' => $items]);
    }
    function img(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        return response()->json(['success' => 'Crop Image Uploaded Successfully', 'image' => $imageName]);
    }
    function store(Request $request)
    {



        // Items::create([
        //     'itm_img' => $request->itm_img,
        //     'itm_description' => $request->itm_description,
        //     'itm_item_code' => $request->itm_item_code,
        //     'itm_category' => $request->itm_category,
        //     'itm_item_name' => $request->itm_item_name,
        //     'itm_item_price' => $request->itm_item_price,
        // ]);
        // $items = Items::all();
        // return redirect()->route('items');
    }
    function getRoomById($id)
    {
        $item = Items::find($id);
        return view('items.items', ['item' => $item]);
    }
    function updateRoom(Request $request)
    {
        Items::where('id', $request->id)
            ->update([
                'rm_number' => $request->rm_number,
                'rm_type' => $request->rm_type,
                'rm_availability' => $request->rm_availability,
            ]);
        $items = Items::all();
        return view('items.items', ['items' => $items]);
    }
    function deleteRoom($id)
    {
        Items::destroy($id);
        $items = Items::all();
        return view('items.items', ['items' => $items]);
    }
}
