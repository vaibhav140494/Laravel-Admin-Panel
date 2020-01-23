<?php

namespace App\Models\Offer;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offer\Traits\OfferAttribute;
use App\Models\Offer\Traits\OfferRelationship;

class Offer extends Model
{
    use ModelTrait,
        OfferAttribute,
    	OfferRelationship {
            // OfferAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'offers';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['offer_name','offer_code','offer_type','offer_desc','min_order_value','max_discount','min_offer_amount','is_active',''

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
        'updated_at',
        'start_date',
        'end_date'
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
}
