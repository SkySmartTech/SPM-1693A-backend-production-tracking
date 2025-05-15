<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_no',
        'operation',
        'sequence_no',
        'smv',
        'status',
    ];

    public function style()
    {
        return $this->belongsTo(StyleSetting::class, 'style_no');
    }

}
