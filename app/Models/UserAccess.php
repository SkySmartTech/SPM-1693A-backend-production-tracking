<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'userType',
        'description',
        'permissionObject',
    ];

    protected $casts = [
        'permissionObject' => 'array',
    ];
}
