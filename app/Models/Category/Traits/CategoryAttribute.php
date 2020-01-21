<?php

namespace App\Models\Category\Traits;

/**
 * Class CategoryAttribute.
 */
trait CategoryAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-category", "admin.categories.edit").'
                            

                '.$this->getDeleteButtonAttribute("delete-category", "admin.categories.destroy").'
                </div>';
    }
    // public function getViewButtonAttribute()
    // {
    //     return '<a target="_blank" href="'.route('frontend.pages.show', $this->page_slug).'" class="btn btn-flat btn-default">
    //                 <i data-toggle="tooltip" data-placement="top" title="View Page" class="fa fa-eye"></i>
    //             </a>';
    // }
}
