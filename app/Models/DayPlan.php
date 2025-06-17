<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'lineNo',
        'respEmployee',
        'buyer',
        'style',
        'gg',
        'smv',
        'displayWH',
        'actualWH',
        'planTgtPcs',
        'perHourPcs',
        'availableCader',
        'presentLinkers',
        'checkPoint',
        'status',
    ];
}
