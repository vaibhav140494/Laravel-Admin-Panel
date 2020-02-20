<?php

namespace App\Models\Subcategory;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory\Traits\SubcategoryAttribute;
use App\Models\Subcategory\Traits\SubcategoryRelationship;

class Subcategory extends Model
{
    use ModelTrait,
        SubcategoryAttribute,
    	SubcategoryRelationship {
            // SubcategoryAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'subcategory_name','subcategory_desc','category_id','is_active'
    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // public function products()
    // {
    //     return $this->hasMany('App\Models\Product\Product');
    // }
}
