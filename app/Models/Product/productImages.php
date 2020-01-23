<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class productImages extends Model
{
    //
    protected $table='productimages';


    protected $fillable = ['product_id','product_image'];

    protected $dates = [
        'created_at',
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
