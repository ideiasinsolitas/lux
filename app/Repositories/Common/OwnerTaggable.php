<?php

namespace App\Repositories\Common;

trait OwnerTaggable
{
    public function getOrCreateTermId($term)
    {
        $id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($id) {
            return $id;
        }
        $id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $id;
    }

    public function addTaxonomyTerm($item_id, $term)
    {
        return DB::table('core_taxonomy')
            ->insert([
                'item_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function getAllTaxonomyTerms($item_id)
    {
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('ownertaggable_type', $this->type)
            ->where('ownertaggable_id', $item_id)
            ->get();
    }

    public function removeTaxonomyTerm($item_id, $term)
    {
        return DB::table('core_taxonomy')
            ->where('ownertaggable_type', $this->type)
            ->where('ownertaggable_id', $ownertaggable_id)
            ->where('term', $term)
            ->delete();
    }
}
