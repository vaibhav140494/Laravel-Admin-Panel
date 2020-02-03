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
        
        $str="";
        //dd($products);
        // dd($this->count);
        // dd($products[$this->count]->type);
            
            if($this->attributes['type'] == 2){
                $str='<a href="'.route('admin.products.productvariations.show',[$this->attributes['id']]).'" class="btn btn-flat btn-default">
                      <i data-toggle="tooltip" data-placement="top" title="custom" class="fa fa-eye"></i>
                      </a>';
            
            }
                return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-product", "admin.products.edit").'
                                '.$this->getDeleteButtonAttribute("delete-product", "admin.products.destroy").'
                                '.'<a href="'.route('admin.products.productimages.galary',[$this->attributes['id']]).'" class="btn btn-flat btn-default">
                                <i data-toggle="tooltip" data-placement="top" title="view galary" class="fa fa-image"></i>
                                </a>'.'
                                '.'<a href="'.route('admin.products.productimages.upload',[$this->attributes['id']]).'" class="btn btn-flat btn-default">
                                <i data-toggle="tooltip" data-placement="top" title="add pictures" class="fa fa-camera"></i>
                                </a>'.'
                                '.$str.'
                        </div>';
            

              
    }
    
}
