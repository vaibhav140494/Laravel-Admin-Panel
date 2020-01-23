<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class productsVariations extends Model
{
    //
    protected $table='variationvalues';


    protected $fillable = ['product_id','variation_values_id','variation_id'];

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
