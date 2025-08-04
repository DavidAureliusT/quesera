<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    const ADMINISTRATOR_ID = '1'; // Lead
    const MEMBER_ID = '2'; // Staff
    const VIEWER_ID = '3'; // HR
}
