<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    //
    protected $table = 'order_details';

    protected $fillable = ['product_id','order_id','quntity','gross_amount','tax_amount','total_amount'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];

}
