<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['user_id','order_id','transaction_id','status','amount','banktransaction_id'];

    protected $attributes = [

    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];
}
