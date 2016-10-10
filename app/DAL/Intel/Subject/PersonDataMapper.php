<?php

namespace App\DAL\Intel\Subject;

use App\DAL\AbstractDataMapper;

class PersonDataMapper extends AbstractDataMapper
{
    public function __construct(PersonDAOContract $dao, ContactDataMapperContract $contacts)
    {
        
    }

    protected function saveRelationships($entity)
    {

    }

    protected function deleteRelationships($entity)
    {
        
    }
}
