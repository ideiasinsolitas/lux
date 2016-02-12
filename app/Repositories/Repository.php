<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Exceptions\GeneralException;

abstract class Repository
{
    protected $table;
    protected $type;
    protected $filters;
    protected $builder;

    public function __construct($table, $type, $filters)
    {
        $this->table = $table;
        $this->type = $type;
        $this->filters = $filters;
        $this->builder = $this->getBuilder();
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->select('*');
    }

    protected function parseFilters($filters, $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }

        if (isset($filters['id'])) {
            $this->builder->where($this->table . '.id', $filters['id']);
        }

        return $this->finish($filters);
    }

    final private function finish($filters)
    {
        if (!isset($filters['sort'])) {
            $filters['sort'] = 'id';
        }

        if (!isset($filters['order'])) {
            $filters['order'] = 'desc';
        }

        $this->builder->orderBy($filters['sort'], $filters['order']);

        if (isset($filters['per_page'])) {
            return $this->builder->paginate($filters['per_page']);
        }

        return $this->builder->get();
    }
}
