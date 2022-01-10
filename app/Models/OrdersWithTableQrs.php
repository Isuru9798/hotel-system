<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersWithTableQrs extends Model
{
    use HasFactory;

    protected $fillable = [
        'owq_table',
        'owq_quantity',
        'owq_service_chrge',
        'items_id',
    ];
}
