<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultInserter
{
    public function create($input)
    {
        $model = $this->modelPath;
        $object = $model::create($input);

        if ($object->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this $this->modelSlug. Please try again.');
    }
}
