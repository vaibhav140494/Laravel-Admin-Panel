<?php

namespace App\Models\Order;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\OrderAttribute;
use App\Models\Order\Traits\OrderRelationship;

class Order extends Model
{
    use ModelTrait,
        OrderAttribute,
    	OrderRelationship {
            // OrderAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'orders';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['user_id','offer_id','order_id','instructions','gross_amount','tax_amount','total_amount','discount','status','type'

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
}
