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




    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be string", 001);
        }

        $sql = "SELECT (id, dev_id, user_id, hash, priority, description, activity, created, modified) 
            FROM tickets
                WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $sql = "INSERT INTO tickets (dev_id, user_id, hash, priority, description, activity, created, modified) 
            VALUES (:dev_id, :user_id, UUID(), :priority, :description, :activity, NOW(), NOW())";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function find($key = 'modified')
    {
        if (!is_string($key)) {
            throw new \Exception("Key must be string.", 002);
        }

        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            WHERE activity > 1
            ORDER BY $key DESC";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  integer $pg       [description]
     * @param  integer $per_page [description]
     * @return [type]            [description]
     */
    public function findAll($pg = 1, $per_page = 20)
    {
        if (!is_int($pg) || !is_int($per_page)) {
            throw new \Exception("Page and per_page must be integers.", 003);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            ORDER BY modified DESC, activity DESC, priority DESC
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  [type] $id       [description]
     * @param  [type] $priority [description]
     * @return [type]           [description]
     */
    public function changePriority($id, $priority)
    {
        if (!is_int($id) || !is_string($priority)) {
            throw new \Exception("Id must be integer and priority must be string.", 004);
        }

        $sql = "UPDATE SET priority=:priority, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'priority' => $priority));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function close($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 005);
        }

        $sql = "UPDATE SET activity=:activity, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('activity' => 1, 'id' => $id));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDev($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 006);
        }

        $sql = "SELECT t2.id, t2.username, t2.name, t2.email FROM tickets t1
            JOIN users t2
                ON t1.dev_id=t2.id
            WHERE t1.id=:id";
        $record = $this->db->run($sql, array('id' => $id))->getFirstRecord();
        if (!$record instanceof Record) {
            throw new \Exception("Invalid record", 1);
        }
        return $record->get('email');
    }
}
