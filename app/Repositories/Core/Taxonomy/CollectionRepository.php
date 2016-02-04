<?php
namespace App\Repositories\Package\Collection;

use App\Models\Package\Collection\Collection;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

class CollectionRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Collection\Collection';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Collection::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getCollectionsPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Collection::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedCollectionsPaginated($per_page)
    {
        return Collection::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllCollections($order_by = 'id', $sort = 'asc')
    {
        return Collection::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws CollectionNeedsRolesException
     */
    public function create($input)
    {
        $name = Collection::create($input);

        if ($name->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this name. Please try again.');
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
        $name = $this->findOrThrowException($id);

        if ($name->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this name. Please try again.');
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

        $name = $this->findOrThrowException($id);
        if ($name->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this name. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $name = $this->findOrThrowException($id, true);

        try {
            $name->forceDelete();
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
        $name = $this->findOrThrowException($id);

        if ($name->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this name. Please try again.");
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

        $name = $this->findOrThrowException($id);
        $name->status = $status;

        if ($name->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this name. Please try again.");
    }











    /*
     * CRUD
     */
    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function insert(Request $request)
    {
        $sql = "INSERT INTO collections (type_id, parent_id, created, modified)
            VALUES (:type_id, :parent_id, NOW(), NOW())";
        $result = $this->db->run($sql, array('type_id' => $request->get('type_id'), 'parent_id' => $request->get('parent_id')));
        $request->remove('parent_id');
        $request->remove('type_id');
        $request->set('item_name', 'collection');
        $request->set('item_id', $result->getLastInsertId());
        $slug = $this->generateSlug($request->get('title'));
        $request->set('slug', $slug);
        $fields = $request->getFieldsList();
        $values = $request->getInsertValueString();
        $sql = "INSERT INTO translations $fields 
            VALUES $values";
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
        $id = $request->get('id');
        $request->remove('id');
        $language = $request->get('language');
        $request->remove('language');
        $sql = "UPDATE collections SET parent_id=:parent_id, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'parent_id' => $request->get('parent_id')));
        $request->remove('parent_id');
        $request->remove('type_id');
        $values = $request->getUpdateValueString();
        $sql = "UPDATE translations SET $values
            WHERE item_id=:id 
                AND language=:language
                AND item_name=:item_name";
        $request->set('language', $language);
        $request->set('item_name', 'collection');
        $request->set('id', $id);
        $result = $this->db->run($sql, $request->toArray());
        return $result;
    }

    /**
     * /
     * @param  string $key   [description]
     * @param  string $order [description]
     * @param  string $lang  [description]
     * @return [type]        [description]
     */
    public function display($key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'language' => $lang));
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
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'language' => $lang));
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
    public function findByType($type, $page = 1, $per_page = 12, $key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t3.name=:type
            AND t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'type' => $type, 'language' => $lang));
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

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.id=:id
            AND t2.language=:language
            AND t1.activity > 0";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'id' => $id, 'language' => $lang));
        return $result;
    }
}
