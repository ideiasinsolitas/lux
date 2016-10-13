<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractEntity;

class Publication extends AbstractEntity
{
    use DefaultEntityTrait;

    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Type,
        Properties\Node,
        Properties\Activity,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted,
        Properties\Language,
        Properties\Slug,
        Properties\Name,
        Properties\Description;

    protected $publisher;

    protected $theme_view;

    protected $frequency;
}
