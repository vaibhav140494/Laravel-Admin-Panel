<?php

namespace App\Models\Subcategory\Traits;

/**
 * Class SubcategoryAttribute.
 */
trait SubcategoryAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> 
        '.$this->getEditButtonAttribute("edit-subcategory", "admin.subcategories.edit").'
                '.$this->getDeleteButtonAttribute("delete-subcategory", "admin.subcategories.destroy").'
                </div>';
    }
}
