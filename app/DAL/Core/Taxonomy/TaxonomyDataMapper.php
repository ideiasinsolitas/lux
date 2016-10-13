<?php

namespace App\DAL\Core\Taxonomy;

use App\DAL\AbstractMapperTrait;
use App\DAL\DefaultDataMapperTrait;

class TaxonomyDataMapper extends AbstractMapperTrait implements TaxonomyDataMapperContract
{
    use DefaultDataMapperTrait;

    public function __construct(TermDAO $dao)
    {
        $this->dao = $dao;
    }
}
