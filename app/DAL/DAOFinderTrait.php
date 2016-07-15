<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\DAL\Features;

trait DAOFinderTrait
{
    /**
     * finds all rows in table
     *
     * @return array|Illuminate\Database\Query\Builder
     */
    public function find()
    {
        return $this->getBuilder()->get();
    }

    /**
     * finds all rows in table, paginated
     *
     * @param  integer $per_page rows per page
     * @return [type]           [description]
     */
    public function findPaginated($per_page)
    {
        return $this->getBuilder()
            ->paginate($per_page);
    }

    /**
     *  finds one row in table, by primary key index
     *
     * @param  integer $id primary key index
     * @return [type]     [description]
     */
    public function findOne($id)
    {
        return $this->getBuilder()
            ->where($this->table . '.' . $this->primaryKey, $id)
            ->get();
    }
}
