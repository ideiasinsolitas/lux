<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Hierachical
{
    protected $elements;

    /**
     * /
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    public function generateTree(array $items)
    {
        $this->elements = array();
        foreach ($items as $item) {
            $this->elements[$item->id] = $item;
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
        foreach ($this->elements as $element) {
            if ((int) $element->parent_id === (int) $branch_id) {
                $leafs = $this->buildTree($element->id);
                if ($leafs) {
                    $element['leafs'] = $leafs;
                }
                $branch[$element->id] = $element;
                unset($this->elements[$element->id]);
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
        return DB::table($this->mainTable)
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
        $id = DB::table($this->mainTable)
            ->select('id')
            ->where('id', $leaf_id);
        return DB::table($this->mainTable)
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $branch_id [description]
     * @return [type]            [description]
     */
    public function getLeafs($branch_id)
    {
        return DB::table($this->mainTable)
            ->where('parent_id', $branch_id)->get();
    }

    /**
     * /
     * @param [type] $branch_id [description]
     * @param [type] $leaf_id  [description]
     */
    public function addLeaf($branch_id, $leaf_id)
    {
        return DB::table($this->mainTable)
            ->update(['parent_id' => $branch_id])
            ->where('id', $leaf_id);
    }

    /**
     * /
     * @param  [type] $leaf_id [description]
     * @return [type]           [description]
     */
    public function removeLeaf($leaf_id)
    {
        return DB::table($this->mainTable)
            ->update(['parent_id' => 0])
            ->where('id', $leaf_id);
    }
}
