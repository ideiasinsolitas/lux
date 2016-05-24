<?php

namespace App\Repositories\Publishing\ContentManagement\Actions;

use App\Repositories\Common\Actions;

trait PublicationAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater,
        Actions\DefaultSelector;
}
