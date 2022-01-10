<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'itm_img',
        'itm_description',
        'itm_item_code',
        'itm_category',
        'itm_item_name',
        'itm_item_price',
    ];
}
