<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckedRooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'rooms_id',
        'check_ins_id',
    ];
}
