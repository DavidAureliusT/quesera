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

    public static final $ADMINISTRATOR_ID = '1';
    public static final $MEMBER_ID = '2';
    public static final $VIEWER_ID = '3';
}
