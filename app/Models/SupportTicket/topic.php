<?php

namespace App\Models\SupportTicket;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    //
    protected $table = 'topics';

    protected $fillable = ['topic','is_active'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];
}
