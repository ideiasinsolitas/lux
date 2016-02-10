<?php

namespace App\Repositories\Common;

trait Typed
{
    public function buildTyped($builder)
    {
        $type = $this->mainTable . '.type_id';
        return $builder
            ->join('core_types', $type, 'core_types.id');
    }
}
