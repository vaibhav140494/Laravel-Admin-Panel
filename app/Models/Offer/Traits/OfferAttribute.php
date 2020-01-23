<?php

namespace App\Models\Offer\Traits;

/**
 * Class OfferAttribute.
 */
trait OfferAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> '.$this->getEditButtonAttribute("edit-offer", "admin.offers.edit").'
                '.$this->getDeleteButtonAttribute("delete-offer", "admin.offers.destroy").'
                </div>';
    }
}
