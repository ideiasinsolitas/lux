<?php

namespace App\DAL\Intel\Subject;

use App\DAL\AbstractDataMapper;

class InstitutionDataMapper extends AbstractDataMapper
{
    public function __construct(InstitutionDAOContract $dao, ContactDataMapperContract $contacts)
    {
        
    }

    protected function fetchRelationships($entity)
    {
        return [
            'contacts' => $this->dao->getContacts($entity->id),
            'facts' => $this->dao->getFacts($entity->id),
        ];
    }

    protected function saveRelationships($entity)
    {
        foreach ($entity->contacts as $contact) {
            $this->contacts->save($contact);
        }
    }

    protected function deleteRelationships($entity)
    {
        foreach ($entity->contacts as $contact) {
            $this->contacts->remove($contact);
        }
    }
}
