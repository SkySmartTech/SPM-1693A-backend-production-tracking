<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'serverDateTime',
        'lineNo',
        'buyer',
        'todayTarget',
        'todayTargetAchieve',
        'todayBalance',
        'uptoNowTarget',
        'uptoNowTargetAchieve',
        'uptoNowBalance',
        'hourlyTarget',
        'hourlyTargetAchieve',
        'hourlyBalance',
        'totalCheckQuantity',
        'totalDefects',
        'DHU',
        'performanceEFI',
        'lineEFI',
    ];
}
