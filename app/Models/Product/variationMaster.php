<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class variationMaster extends Model
{
    //
    protected $table='variationmaster';


    protected $fillable = ['variation_name','is_active'];

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

    public function variationValues()
    {
        return $this->hasMany('App\Models\Product\variationValues','variation_id','id');
    }
}
