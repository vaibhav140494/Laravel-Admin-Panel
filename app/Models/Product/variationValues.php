<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class variationValues extends Model
{
    //
    protected $table='variationvalues';


    protected $fillable = ['variation_value','variation_id'];

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
