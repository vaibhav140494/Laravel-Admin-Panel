<?php

namespace App\Models\SupportTicket\Traits;

/**
 * Class SupportTicketAttribute.
 */
trait SupportTicketAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-supportticket", "admin.supporttickets.edit")}
                {$this->getDeleteButtonAttribute("delete-supportticket", "admin.supporttickets.destroy")}
                </div>';
    }
}
