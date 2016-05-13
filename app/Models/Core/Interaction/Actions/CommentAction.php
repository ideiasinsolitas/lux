<?php

namespace App\Models\Core\Interaction\Actions;

use App\Models\Common\Actions as CommonActions;

trait CommentAction
{
    use CommonActions\DefaultModifier,
        CommonActions\DefaultDeleter,
        CommonActions\Hierarchical;
}
