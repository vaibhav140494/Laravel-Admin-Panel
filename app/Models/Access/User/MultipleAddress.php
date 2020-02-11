<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

class MultipleAddress extends Model
{
    protected $table='multiple_address';
    
    protected $fillable = [
        'user_id',
        'contact_person',
        'contact_person_no',
        'addrss',
        'pincode',
        'city',
        'state',
        'country',
        'created_by',
        'updated_by',
    ];
}