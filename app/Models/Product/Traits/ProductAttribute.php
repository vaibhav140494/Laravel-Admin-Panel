<?php

namespace App\Models\Product\Traits;
use  App\Models\Product\Product;
use DB;
/**
 * Class ProductAttribute.
 */
trait ProductAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {   
        
        // echo "<pre>"; print_r($this->attributes['type']); 
        $products=Product::select('type')->get();
        
            if($products[$this->count]->type != 2){
                $var=$products[$this->count]->type.$this->count;
                $this->count++;
                return $var;
                return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-product", "admin.products.edit").'
                                '.$this->getDeleteButtonAttribute("delete-product", "admin.products.destroy").'
                                '.$this->getCostumButtonsAttribute().'
                        </div>';
            }
            else{ 
                $var=$products[$this->count]->type.$this->count;
                $this->count++;
                return $var;
                // return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-product", "admin.products.edit").'
                //                                            '.$this->getDeleteButtonAttribute("delete-product", "admin.products.destroy").'
                //            </div>';
            }     
              
    }
    public function getCostumButtonsAttribute()
    {
        return '<a target="_blank" href="" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="edit product" class="fa fa-wrench"></i>
                </a>';
    }
}
