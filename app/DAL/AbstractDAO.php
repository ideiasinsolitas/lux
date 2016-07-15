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

use App\DAL\Contracts\QueryBuilderContract;

abstract class AbstractDAO
{
    protected $filters;

    protected $builder;

    /**
     * /
     * @param  array  $item [description]
     * @return [type]       [description]
     */
    abstract public function insert(array $item);
   
    /**
     * /
     * @param  array  $item    [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    abstract public function update(array $item, $item_id);
    
    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    abstract public function delete($item_id);
}
