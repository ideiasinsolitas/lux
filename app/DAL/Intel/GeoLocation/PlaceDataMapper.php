<?php

namespace App\DAL\Intel\GeoLocation;

use App\DAL\AbstractDataMapper;

class PlaceDataMapper extends AbstractDataMapper
{
    protected $dao;

    protected $addresses;

    public function __construct(PlaceDAOContract $dao, AddressDataMapperContract $addresses)
    {
        $this->dao = $dao;
        $this->addresses = $addresses;
    }

    protected function fetchRelationships($entity)
    {
        return [
            'address' => $this->dao->getAddress($entity->id)
        ];
    }

    protected function saveRelationships($entity)
    {
        $this->addresses->save($entity->address);
    }

    protected function deleteRelationships($entity)
    {
        
    }
}
