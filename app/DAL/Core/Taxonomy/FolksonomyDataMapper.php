<?php

namespace App\DAL\Core\Taxonomy;

use App\DAL\AbstractMapperTrait;
use App\DAL\DefaultDataMapperTrait;

class FolksonomyDataMapper extends AbstractMapperTrait implements FolksonomyDataMapperContract
{
    use DefaultDataMapperTrait;

    public function __construct(TermDAO $dao)
    {
        $this->dao = $dao;
    }
}
