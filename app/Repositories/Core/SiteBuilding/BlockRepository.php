<?php
namespace App\Repositories\Core\SiteBuilding\Block;

use App\Models\Core\SiteBuilding\Block\Block;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentBlockRepository
 * @package App\Repositories\Block
 */
class BlockRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\SiteBuilding\Block';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Block::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getBlocksPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Block::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedBlocksPaginated($per_page = 20)
    {
        return Block::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllBlocks($order_by = 'id', $sort = 'asc')
    {
        return Block::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws BlockNeedsRolesException
     */
    public function create($input)
    {
        $block = Block::create($input);

        if ($block->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this block. Please try again.');
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
        $block = $this->findOrFail($id);

        if ($block->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this block. Please try again.');
    }
}
