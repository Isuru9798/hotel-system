<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    protected $fillable = [
        'gs_name',
        'gs_address',
        'gs_gender',
        'gs_passport_or_id',
        'gs_mobile',
        'gs_country',
    ];
}
