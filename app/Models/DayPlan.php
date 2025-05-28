<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'line_no',
        'resp_employee',
        'buyer',
        'style',
        'gg',
        'smv',
        'display_wh',
        'actual_wh',
        'plan_tgt_pcs',
        'per_hour_pcs',
        'available_cader',
        'present_linkers',
        'check_point',
        'status',
    ];
}
