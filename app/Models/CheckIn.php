<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'ci_in_date',
        'ci_out_date',
        'ci_nights',
        'ci_adults',
        'ci_child',
        'ci_status',
        'guests_id',
    ];
}
