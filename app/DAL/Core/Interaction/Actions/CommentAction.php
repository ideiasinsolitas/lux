<?php

namespace App\DAL\Core\Interaction\Actions;

use App\DAL\Common\Actions as CommonActions;

trait CommentAction
{
    use CommonActions\DefaultModifier,
        CommonActions\DefaultDeleter,
        CommonActions\DefaultSelector,
        CommonActions\Tree;
}
