<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'or_quantity',
        'or_status',
        'or_tot',
        'or_service_chrge',
        'checked_rooms_id',
        'items_id',
    ];
}
