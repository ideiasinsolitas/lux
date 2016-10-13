<?php

namespace App\DAL\Publishing\ContentManagement\Contracts;

interface PublicationDAOContract
{
    const TABLE = 'publishing_publications';
    const PK = 'id';
    const INTERNAL_TYPE = 'Publication';
}
