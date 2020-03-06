<?php

namespace App\Models\Contact\Traits;

/**
 * Class ContactAttribute.
 */
trait ContactAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-contact", "admin.contacts.edit")}
                {$this->getDeleteButtonAttribute("delete-contact", "admin.contacts.destroy")}
                </div>';
    }
}
