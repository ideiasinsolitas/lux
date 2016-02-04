<?php
namespace App\Repositories\Core\Taxonomy\Term;

use App\Models\Core\Taxonomy\Term\Term;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTermRepository
 * @package App\Repositories\Term
 */
class TermRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Taxonomy\Term\Term';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Term::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTermsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Term::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTermsPaginated($per_page = 20)
    {
        return Term::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTerms($order_by = 'id', $sort = 'asc')
    {
        return Term::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws TermNeedsRolesException
     */
    public function create($input)
    {
        $term = Term::create($input);

        if ($term->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this term. Please try again.');
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
        $term = $this->findOrFail($id);

        if ($term->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this term. Please try again.');
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

        $term = $this->findOrFail($id);
        if ($term->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this term. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $term = $this->findOrFail($id, true);

        try {
            $term->forceDelete();
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
        $term = $this->findOrFail($id);

        if ($term->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this term. Please try again.");
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

        $term = $this->findOrFail($id);
        $term->status = $status;

        if ($term->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this term. Please try again.");
    }





    /*
     * CRUD
     */
    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $sql = "INSERT INTO terms (type_id, parent_id)
            VALUES (:type_id, :parent_id)";
        $result = $this->db->run($sql, array('type_id' => $record->get('type_id'), 'parent_id' => $record->get('parent_id')));
        $record->remove('type_id');
        $record->remove('parent_id');
        $record->set('item_name', 'term');
        $record->set('item_id', $result->getLastInsertId());
        $slug = $this->generateSlug($record->get('title'));
        $record->set('slug', $slug);
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO translations $fields 
            VALUES $values";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function update(Record $record)
    {
        $id = $record->get('id');
        $record->remove('id');
        $language = $record->get('language');
        $record->remove('language');
        $sql = "UPDATE terms SET parent_id=:parent_id WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'parent_id' => $record->get('parent_id')));
        $record->remove('type_id');
        $record->remove('parent_id');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE translations SET $values
            WHERE item_id=:id 
                AND language=:language
                AND item_name=:item_name";
        $record->set('language', $language);
        $record->set('item_name', 'term');
        $record->set('id', $id);
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  string $key   [description]
     * @param  string $order [description]
     * @param  string $lang  [description]
     * @return [type]        [description]
     */
    public function display($key = 'type', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t1.activity > 0
            AND t2.language=:lang
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'term', 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function find($page = 1, $per_page = 12, $key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'term', 'language' => $lang));
        return $result;
    }

    /**
     * /
     * @param  [type]  $type     [description]
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function findByType($type, $page = 1, $per_page = 12, $key = 'name', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t3.name=:type
            AND t1.activity > 0
            AND t2.language=:lang
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('type' => $type, 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param  [type] $id   [description]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public function show($id, $lang = 'pt-br')
    {
        if (!is_int($id) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN translations t2 
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id
            WHERE t1.id=:id
        AND t2.language=:lang
        AND t1.activity > 0";
        $result = $this->db->run($sql, array('id' => $id, 'item_name' => 'term', 'lang' => $lang));
        return $result;
    }
}
