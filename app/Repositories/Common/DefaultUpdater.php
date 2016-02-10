<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultUpdater
{
    public function update($id, $input)
    {
        $model = $this->modelPath;
        $object = $this->findOrFail($id);

        if ($object->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this $this->modelSlug. Please try again.');
    }
}
