<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundries extends Model
{
    use HasFactory;
    protected $fillable = [
        'lon_issue_date',
        'lon_status',
        'lon_item',
        'lon_amount',
        'lon_quantity',
        'checked_rooms_id',
    ];
}
