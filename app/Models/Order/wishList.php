<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class wishList extends Model
{
    //
    protected $table='wishlist';

    protected $fillable=['user_id','product_id'];

    protected $date=[
            'created_at',
            'updated_at'
    ];
    protected $guarded = [
        'id'
    ];
}
