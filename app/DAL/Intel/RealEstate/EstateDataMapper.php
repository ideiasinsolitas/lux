<?php

namespace App\DAL\Intel\RealEstate;

use App\DAL\AbstractDataMapper;

class EstateDataMapper extends AbstractDataMapper
{
    protected $dao;

    protected $places;

    public function __construct(EstateDAOContract $dao, PlaceDataMapperContract $places)
    {
        $this->dao = $dao;
        $this->places = $places;
    }

    protected function saveRelationships($entity)
    {
        $this->places->save($entity->place);
    }
}
