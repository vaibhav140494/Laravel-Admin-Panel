<?php

namespace App\Repositories\Backend\SupportTicket;

use DB;
use Carbon\Carbon;
use App\Models\SupportTicket\SupportTicket;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SupportTicketRepository.
 */
class SupportTicketRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = SupportTicket::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.supporttickets.table').'.id',
                config('module.supporttickets.table').'.created_at',
                config('module.supporttickets.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        if (SupportTicket::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.supporttickets.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param SupportTicket $supportticket
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(SupportTicket $supportticket, array $input)
    {
    	if ($supportticket->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.supporttickets.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param SupportTicket $supportticket
     * @throws GeneralException
     * @return bool
     */
    public function delete(SupportTicket $supportticket)
    {
        if ($supportticket->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.supporttickets.delete_error'));
    }
}
