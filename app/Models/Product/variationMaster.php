<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class variationMaster extends Model
{
    //
    protected $table='variationmaster';


    protected $fillable = ['variation_name','is_active','category_id'];

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
