<?php

namespace App\DAL\Intel\Subject;

use App\DAL\AbstractDataMapper;

class ContactDataMapper extends AbstractDataMapper
{
    public function __construct(ContactDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
