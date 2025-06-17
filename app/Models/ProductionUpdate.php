<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'serverDateTime',
        'lineNo',
        'QRCode',
        'buyer',
        'gg',
        'smv',
        'presentCarder',
        'style',
        'color',
        'sizeName',
        'checkPoint',
        'qualityState',
        'part',
        'location',
        'defectCode',
        'state',
    ];
}
