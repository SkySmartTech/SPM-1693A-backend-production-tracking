<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_date_time',
        'line_no',
        'qr_code',
        'buyer',
        'gg',
        'smv',
        'present_carder',
        'style',
        'color',
        'size_name',
        'check_point',
        'quality_state',
        'part',
        'location',
        'defect_code',
        'state',
    ];
}
