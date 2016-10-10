<?php

namespace App\DAL;

trait DAOTrait
{
    // internal
    final protected function finish(array $filters = array())
    {
        if (!isset($filters['sort'])) {
            $filters['sort'] = self::PK . ',asc';
        }

        $sort = explode(',', $filters['sort']);
        $this->builder->orderBy($sort[0], $sort[1]);

        if (isset($filters['per_page'])) {
            return (array) $this->builder->paginate($filters['per_page']);
        }

        if (isset($filters[self::PK])) {
            return (array) $this->builder->where(self::TABLE . '.' . self::PK, $filters[self::PK])->first();
        }

        return $this->builder->get();
    }
}
