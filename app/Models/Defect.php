<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_no',
        'operation',
        'code_no',
        'defect_code',
        'status',
    ];

    // public function style()
    // {
    //     return $this->belongsTo(StyleSetting::class, 'style_no', 'style_no');
    // }
}
