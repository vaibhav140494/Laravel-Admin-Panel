<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    protected $table='subcategories';


    protected $fillable = ['sub_cat_name','sub_cat_desc','is_active'];

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
