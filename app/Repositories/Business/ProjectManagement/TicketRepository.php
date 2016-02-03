<?php
namespace App\Repositories\Package\Ticket;

use App\Models\Package\Ticket\Ticket;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTicketRepository
 * @package App\Repositories\Ticket
 */
class TicketRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Ticket\Ticket';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Ticket::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTicketsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Ticket::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTicketsPaginated($per_page = 20)
    {
        return Ticket::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTickets($order_by = 'id', $sort = 'asc')
    {
        return Ticket::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws TicketNeedsRolesException
     */
    public function create($input)
    {
        $ticket = Ticket::create($input);

        if ($ticket->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this ticket. Please try again.');
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $ticket = $this->findOrFail($id);

        if ($ticket->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this ticket. Please try again.');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            throw new GeneralException("You can not delete yourself.");
        }

        $ticket = $this->findOrFail($id);
        if ($ticket->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this ticket. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $ticket = $this->findOrFail($id, true);

        try {
            $ticket->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $ticket = $this->findOrFail($id);

        if ($ticket->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this ticket. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if (auth()->id() == $id && ($status == 0 || $status == 2)) {
            throw new GeneralException("You can not do that to yourself.");
        }

        $ticket = $this->findOrFail($id);
        $ticket->status = $status;

        if ($ticket->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this ticket. Please try again.");
    }
}
