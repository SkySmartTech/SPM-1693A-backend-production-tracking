<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_name',
        'description',
    ];
}
