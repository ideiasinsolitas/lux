<?php

namespace App\DAL\Publishing\ContentManagement\Contracts;

interface PublicationDataMapperContract
{
    /**
     * /
     */
    const ENTITY_CLASS = 'App\Entitys\Publishing\ContentManagement\Publication';

    /**
     * /
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function fetchBySlug($slug);

    /**
     * @param $id
     * @return mixed
     */
    public function fetchByPublisherId($publisher_id);
}
