<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

class resetPasswword extends Model
{
    //
    protected $table = 'password_reset';

    protected $fillable = ['email'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];
}

