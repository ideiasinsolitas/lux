<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractEntity;
use App\DAL\Common\Properties;

class Content extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Type,
        Properties\Parent,
        Properties\Children,
        Properties\Node,
        Properties\Activity,
        Properties\DatePublished,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted,
        Properties\Language,
        Properties\Slug,
        Properties\Title;

    protected $publication;

    protected $issue;

    protected $subtitle;

    protected $tagline;

    protected $excerpt;

    protected $body;
}
