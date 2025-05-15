<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_no',
        'style_description',
        'state',
        'status',
    ];

    public function operations()
    {
        return $this->hasMany(Operation::class, 'style_no');
    }

}
