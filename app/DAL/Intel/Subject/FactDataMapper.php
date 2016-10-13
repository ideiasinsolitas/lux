<?php

namespace App\DAL\Intel\Subject;

use App\DAL\AbstractDataMapper;

class FactDataMapper extends AbstractDataMapper
{
    public function __construct(
        FactDAOContract $dao,
        PlaceDataMapperContract $places,
        InstitutionDataMapperContract $institutions,
        PersonDataMapperContract $people
    ) {
        
    }
    
    protected function fetchRelationships($entity)
    {
        return [
            'place' => $this->dao->getPlace($entity->id),
            'institutions' => $this->dao->getInstitutions($entity->id),
            'people' => $this->dao->getPeople($entity->id),
        ];
    }

    protected function saveRelationships($entity)
    {
        $this->places->save($entity->place);

        foreach ($entity->institutions->all() as $institution) {
            $this->institutions->save($institution);
        }
        
        foreach ($entity->people->all() as $person) {
            $this->people->save($person);
        }
    }

    protected function deleteRelationships($entity)
    {
        
    }
}
