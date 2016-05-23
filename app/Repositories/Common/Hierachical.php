<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Hierachical
{
    protected $leafs;

    /**
     * /
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    public function generateTree(array $items)
    {
        $this->leafs = array();
        foreach ($items as $item) {
            $this->leafs[$item->id] = $item;
        }
        return $this->buildTree();
    }

    /**
     * /
     * @param  integer $branch_id [description]
     * @return [type]             [description]
     */
    public function buildTree($branch_id = 0)
    {
        $branch = array();
        foreach ($this->leafs as $element) {
            if ((int) $element->parent_id === (int) $branch_id) {
                $leafs = $this->buildTree($element->id);
                if ($leafs) {
                    $element['leafs'] = $leafs;
                }
                $branch[$element->id] = $element;
                unset($this->leafs[$element->id]);
            }
        }
        return $branch;
    }

    /**
     * /
     * @param [type]  $leaf_id  [description]
     * @param integer $branch_id [description]
     */
    public function setBranch($leaf_id, $branch_id = 0)
    {
        return DB::table($this->table)
            ->update(['parent_id' => $branch_id])
            ->where('id', $leaf_id);
    }

    /**
     * /
     * @param  [type] $leaf_id [description]
     * @return [type]           [description]
     */
    public function getBranch($leaf_id)
    {
        $id = DB::table($this->table)
            ->select('id')
            ->where('id', $leaf_id);
        return DB::table($this->table)
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $branch_id [description]
     * @return [type]            [description]
     */
    public function getLeafs($branch_id)
    {
        return DB::table($this->table)
            ->where('parent_id', $branch_id)->get();
    }

    /**
     * /
     * @param [type] $branch_id [description]
     * @param [type] $leaf_id  [description]
     */
    public function addLeaf($branch_id, $leaf_id)
    {
        return DB::table($this->table)
            ->update(['parent_id' => $branch_id])
            ->where('id', $leaf_id);
    }

    /**
     * /
     * @param [type] $branch_id [description]
     * @param [type] $leaf_id  [description]
     */
    public function addLeaves($branch_id, $leaves_id)
    {
        return DB::table($this->table)
            ->update(['parent_id' => $branch_id])
            ->whereIn('id', $leaves_id);
    }

    /**
     * /
     * @param  [type] $leaf_id [description]
     * @return [type]           [description]
     */
    public function removeLeaf($leaf_id)
    {
        return DB::table($this->table)
            ->update(['parent_id' => 0])
            ->where('id', $leaf_id);
    }
}
