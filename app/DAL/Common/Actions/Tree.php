<?php

namespace App\DAL\Common\Actions;

trait Tree
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
        if (!is_int($leaf_id) || !is_int($branch_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->where(self::PK, $leaf_id);
    }

    public function getBranch($leaf_id)
    {
        if (!is_int($leaf_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $id = DB::table(self::TABLE)
            ->select('parent_id')
            ->where(self::PK, $leaf_id);
        return $this->builder->where(self::PK, $id->parent_id)->get();
    }

    public function getLeaves($branch_id)
    {
        if (!is_int($branch_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->builder->where('parent_id', $branch_id)->get();
    }

    public function addLeaf($branch_id, $leaf_id)
    {
        if (!is_int($branch_id) || !is_int($leaf_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->where(self::PK, $leaf_id);
    }

    public function addLeaves($branch_id, array $leaves_ids)
    {
        if (!is_int($branch_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->update(['parent_id' => $branch_id])
            ->whereIn(self::PK, $leaves_ids);
    }

    public function removeLeaf($leaf_id)
    {
        if (!is_int($leaf_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->update(['parent_id' => 0])
            ->where(self::PK, $leaf_id);
    }
}
