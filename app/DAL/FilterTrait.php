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

use Illuminate\Database\Query\Builder;

/**
 * @author Pedro Koblitz <pedrokoblitz@estudiotouch.com>
 */
trait FilterTrait
{
    /**
     * /
     * @param  array        $filters [description]
     * @param  Builder|null $builder [description]
     * @return [type]                [description]
     */
    public function filter(array $filters, Builder $builder = null)
    {
        $builder = $builder ? $builder : $this->getBuilder();

        if (!isset($filters['sort'])) {
            $filters['sort'] = 'id';
        }

        if (!isset($filters['order'])) {
            $filters['order'] = 'desc';
        }

        $builder->orderBy($filters['sort'], $filters['order']);

        if (isset($filters['per_page'])) {
            return $builder->paginate($filters['per_page']);
        }

        return $builder->get();
    }
}
