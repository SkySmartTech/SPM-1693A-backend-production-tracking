<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'part',
        'location',
    ];
}
