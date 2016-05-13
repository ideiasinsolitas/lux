<?php

namespace App\Models\Actions\Common;

trait Hierachical
{
    protected $leafs;

    public function generateTree(array $items)
    {
        $this->leafs = array();
        foreach ($items as $item) {
            $this->leafs[$item->id] = $item;
        }
        return $this->buildTree();
    }

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

    public function setBranch($leaf_id, $branch_id = 0)
    {
        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->where('id', $leaf_id);
    }

    public function getBranch($leaf_id)
    {
        $id = DB::table(self::TABLE)
            ->select('parent_id')
            ->where('id', $leaf_id);
        return $this->builder->where('id', $id)->get();
    }

    public function getLeafs($branch_id)
    {
        return $this->builder->where('parent_id', $branch_id)->get();
    }

    public function addLeaf($branch_id, $leaf_id)
    {
        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->where('id', $leaf_id);
    }

    public function addLeaves($branch_id, $leaves_id)
    {
        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->whereIn('id', $leaves_id);
    }

    public function removeLeaf($leaf_id)
    {
        return DB::table(self::TABLE)
            ->update(['parent_id' => 0])
            ->where('id', $leaf_id);
    }
}
