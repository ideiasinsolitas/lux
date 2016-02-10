<?php
namespace App\Repositories\Core\Sys\Type;

use App\Models\Core\Sys\Type\Type;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTypeRepository
 * @package App\Repositories\Type
 */
class TypeRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Sys\Type\Type';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Type::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTypesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Type::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTypesPaginated($per_page = 20)
    {
        return Type::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTypes($order_by = 'id', $sort = 'asc')
    {
        return Type::orderBy($order_by, $sort)->get();
    }

    public function create($input)
    {
        return DB::table('core_types')
            ->insertGetId($input);
    }

    public function update($input)
    {
        return DB::table('core_types')
            ->update($input)
            ->where('id', $input['id']);
    }
}
