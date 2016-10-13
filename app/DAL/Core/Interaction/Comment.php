<?php

namespace App\DAL\Core\Interaction;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Comment extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Nodable;

    protected $comment;

    public function setComment($value)
    {
        $this->comment = $this->checkValueType($value, "string");
    }
}
