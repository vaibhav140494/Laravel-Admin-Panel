<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    protected $table = 'cart';

    protected $fillable = ['user_id','product_id','order_id','cart_id','quntity','gross_amount','tax_amount','total_amount'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];
}
