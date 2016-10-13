<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\DAL;

trait DAOFinderTrait
{
    /**
     * finds all rows in table
     *
     * @return array|Illuminate\Database\Query\Builder
     */
    public function getAll($filters)
    {
        return $this->parseFilters($filters);
    }

    /**
     * finds all rows in table, paginated
     *
     * @param  integer $per_page rows per page
     * @return [type]           [description]
     */
    public function getPaginated($filters, $per_page)
    {
        $filters['per_page'] = $per_page;
        return $this->parseFilters($filters);
    }

    /**
     *  finds one row in table, by primary key index
     *
     * @param  integer $id primary key index
     * @return [type]     [description]
     */
    public function getOne($id, $filters)
    {
        $filters[self::PK] = $id;
        return $this->parseFilters($filters);
    }
}
