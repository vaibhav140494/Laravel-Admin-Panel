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
    public $count=0;
    public function getActionButtonsAttribute()
    {   
        
        $products=DB::table('products')
                    ->select('type')
                    ->get();
        //dd($products);
          dd($this->count);
        // dd($products[$this->count]->type);
            if($products[$this->count]->type == 2){
                $this->count++;
                
                return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-product", "admin.products.edit").'
                                '.$this->getDeleteButtonAttribute("delete-product", "admin.products.destroy").'
                                '.$this->getCostumButtonsAttribute().'
                        </div>';
            }
            else{ 
                $this->count++;
                return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-product", "admin.products.edit").'
                                                           '.$this->getDeleteButtonAttribute("delete-product", "admin.products.destroy").'
                           </div>';
            }     
              
    }
    public function getCostumButtonsAttribute()
    {
        return '<a target="_blank" href="" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="edit product" class="fa fa-wrench"></i>
                </a>';
    }
}
