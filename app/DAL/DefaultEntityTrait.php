<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\DAL;

trait DefaultEntityTrait
{
    use DefaultHydrationTrait,
        GetterAccessorTrait,
        SetterAccessorTrait,
        IsNullAccessorTrait,
        HasAccessorTrait,
        SerializableTrait,
        HashableTrait,
        TypeValidationTrait,
        Common\Properties\ToString,
        Common\Properties\InternalProperties;
}
