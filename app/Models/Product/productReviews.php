<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class productReviews extends Model
{
    //
    protected $table='productreviews';


    protected $fillable = ['product_id','user_id','rating','review'];

    protected $dates = [
        'created_at',
        'review_date',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
