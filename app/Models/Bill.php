<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'bill_tot',
        'invoice_num',
        'status',
        'guests_id',
        'checked_rooms_id'
    ];
}
