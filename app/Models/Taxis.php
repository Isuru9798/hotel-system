<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxis extends Model
{
    use HasFactory;
    protected $table = 'taxis';

    protected $fillable = [
        'tx_destination',
        'tx_vehicle_num',
        'tx_status',
        'tx_num_of_days',
        'tx_issue_date',
        'tx_amount',
        'tx_tax',
        'checked_rooms_id',
    ];
}
