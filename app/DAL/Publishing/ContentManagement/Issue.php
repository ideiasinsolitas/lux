<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractEntity;

class Issue extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $publication;
}
