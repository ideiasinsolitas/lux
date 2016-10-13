<?php

namespace App\DAL\Intel\GeoLocation;

use App\DAL\AbstractDataMapper;

class AddressDataMapper extends AbstractDataMapper
{
    protected $dao;

    protected $coordinates;

    public function __construct(AddressDAOContract $dao, CoordinateDataMapperContract $coordinates)
    {
        $this->dao = $dao;
        $this->coordinates = $coordinates;
    }
    
    protected function fetchRelationships($entity)
    {
        return [
            'places' => $this->getPlace($entity->id),
            'coordinates' => $this->dao->getCoordinates($entity->id)
        ];
    }

    protected function saveRelationships($entity)
    {
        $this->coordinates->save($entity->coordinate);
    }

    protected function deleteRelationships($entity)
    {
        
    }
}
