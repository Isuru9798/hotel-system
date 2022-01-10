<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBills extends Model
{
    use HasFactory;
    protected $fillable = [
        'rb_issue_date',
        'rb_doller_rate',
        'rb_amount_doller',
        'rb_cost',
        'rb_status',
        'checked_rooms_id',
    ];
}
