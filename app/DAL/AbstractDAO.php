<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

abstract class AbstractDAO
{
    protected $filters;
    protected $builder;

    public function __construct(array $filters = array())
    {
        $this->filters = $filters;
        $this->builder = $this->getBuilder();
    }

    abstract protected function parseFilters(array $filters, $defaults = true);

    final protected function finish(array $filters = array())
    {
        if (!isset($filters['sort'])) {
            $filters['sort'] = self::PK . ',asc';
        }

        $sort = explode(',', $filters['sort']);
        $this->builder->orderBy($sort[0], $sort[1]);

        if (isset($filters['per_page'])) {
            return $this->builder->paginate($filters['per_page']);
        }

        if (isset($filters['pk'])) {
            return $this->builder->where(self::TABLE . '.' . self::PK, $filters['pk'])->first();
        }

        return $this->builder->get();
    }

    abstract public function getBuilder();
 
    abstract public function insert(array $input);

    abstract public function update(array $input, $pk);
}
