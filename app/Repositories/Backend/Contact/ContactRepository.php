<?php

namespace App\Repositories\Backend\Contact;

use DB;
use Carbon\Carbon;
use App\Models\Faqs\contact;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactRepository.
 */
class ContactRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = contact::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {   //dd('hello');
        return $this->query()
            ->select([
                config('module.contacts.table').'.id',
                config('module.contacts.table').'.name',
                config('module.contacts.table').'.email',
                config('module.contacts.table').'.subject',
                config('module.contacts.table').'.message',
                config('module.contacts.table').'.created_at',
                config('module.contacts.table').'.updated_at',
            ]);
    }

}
