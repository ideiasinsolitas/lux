<?php
namespace App\Repositories\Package\Project;

use App\Models\Package\Project\Project;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentProjectRepository
 * @package App\Repositories\Project
 */
class ProjectRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Project\Project';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getProjectsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Project::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedProjectsPaginated($per_page = 20)
    {
        return Project::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllProjects($order_by = 'id', $sort = 'asc')
    {
        return Project::orderBy($order_by, $sort)->get();
    }


    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function create(Request $request)
    {
        $sql = "INSERT INTO projects (title, description, activity) VALUES (:title, :description, :activity)";
        $result = $this->db->run($sql, $request->toArray());
        return $result;
    }

    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function update(Request $request)
    {
        $sql = "UPDATE projects SET title=:title, description=:description, activity=:activity";
        $result = $this->db->run($sql, $request->toArray());
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function findOne($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 001);
        }

        $sql = "SELECT title, description, activity FROM projects WHEERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    /**
     * /
     * @param  integer $pg       [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @return [type]            [description]
     */
    public function findAll($pg = 1, $per_page = 12, $key = 'title', $order = 'asc')
    {
        if (!is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings.", 002);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT title, description, activity FROM projects
            ORDER BY $key $order
            LIMIT $pagination->offset, $pagination->limit
            WHERE activity > :activity";
        $result = $this->db->run($sql, array('activity' => 0));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDevs($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer", 003);
        }

        $sql = "SELECT t1.id, t1.username, t1.name, t1.email
            FROM users t1
            JOIN tickets t2
                ON t1.id=t2.dev_id
            WHERE t2.project_id=:project_id";
        $result = $this->db->run($sql, array('project_id' => $id));
        return $result;
    }

    /**
     * /
     * @param [type] $id      [description]
     * @param [type] $user_id [description]
     */
    public function addUser($id, $user_id)
    {
        if (!is_int($id) || !is_int($user_id)) {
            throw new \Exception("Id and user_id must be integers.", 004);
        }

        $sql = "INSERT INTO attachments (group_name, group_id, item_name, item_id) VALUES (:group_name, :group_id, :item_name, :item_id)";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user', 'item_id' => $user_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $id      [description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function removeUser($id, $user_id)
    {
        if (!is_int($id) || !is_int($user_id)) {
            throw new \Exception("Id and user_id must be integers.", 005);
        }

        $sql = "DELETE FROM attachments WHERE group_name=:group_name AND group_id=:group_id AND item_name=:item_name AND item_id=:item_id";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user', 'item_id' => $user_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getUsers($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 006);
        }

        $sql = "SELECT t1.id, t1.username, t1.name, t1.email
            FROM users t1
            JOIN attachments t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.group_id=:project_id
                AND t2.group_name=:group_name";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user'));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getTickets($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 007);
        }

        $sql = "SELECT t1.id, t2.id as user_id, t2.name, t2.email FROM tickets t1 
            JOIN users t2
                ON t1.dev_id=t2.id
            WHERE project_id=:project_id";
        $result = $this->db->run($sql, array('project_id' => $id));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getInvoices($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 008);
        }

        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets WHERE project_id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBillableHours($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 009);
        }

        $sql = "SELECT
            SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
            t4.value as rate,
            totalhours*rate AS total,
            t3.title AS title -- add activity for proj report and proj.title for full report
              FROM ticket_time_tracking t1 
              JOIN tickets t2
                ON t1.ticket_id=t2.id
              JOIN projects t3
                ON t2.project_id=t3.id
              JOIN metadata t4
                ON t1.dev_id=t4.item_id
                AND t4.item_name=:user_item
                AND t4.key=:meta_key
            WHERE t2.project_id=:project_id -- (remove for total report)
                AND t2.activity = :activity";
        $result = $this->db->run($sql, array('activity' => 4, 'project_id' => $id, 'user_item' => 'user', 'meta_key' => 'hourly_rate'));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function createReport($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 010);
        }

        $sql = "SELECT
            SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
            t4.value as rate,
            totalhours*rate AS total,
            t3.title AS title -- add activity for proj report and proj.title for full report
              FROM ticket_time_tracking t1 
              JOIN tickets t2
                ON t1.ticket_id=t2.id
              JOIN projects t3
                ON t2.project_id=t3.id
              JOIN metadata t4
                ON t1.dev_id=t4.item_id
                AND t4.item_name=:user_item
                AND t4.key=:meta_key
            WHERE t2.activity = :activity";
        $result = $this->db->run($sql, array('activity' => 4, 'user_item' => 'user', 'meta_key' => 'hourly_rate'));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function createInvoice($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 011);
        }

        $request = $this->getBillableHours($id)->getFirstRequest();
        if (!$request instanceof Request) {
            throw new \Exception("Not a valid record.", 1);
        }
        $request->set('activity', 1);
        return Invoice::query($this->db, 'save', $request);
    }
}
