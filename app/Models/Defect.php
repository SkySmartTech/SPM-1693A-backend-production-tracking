<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
    use HasFactory;

    protected $fillable = [
        'styleNo',
        'operation',
        'codeNo',
        'defectCode',
        'status',
    ];

    // public function style()
    // {
    //     return $this->belongsTo(StyleSetting::class, 'style_no', 'style_no');
    // }
}
