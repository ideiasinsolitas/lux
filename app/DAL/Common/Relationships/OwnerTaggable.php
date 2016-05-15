<?php

namespace App\DAL\Relationships\Common;

trait OwnerTaggable
{
    public function getOrCreateTermId($term)
    {
        $term_id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($term_id) {
            return $term_id->id;
        }
        $term_id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $term_id;
    }

    public function addTaxonomyTerm($item_id, $term)
    {
        return DB::table('core_taxonomy')
            ->insert([
                'ownertaggable_type' => self::INTERNAL_TYPE,
                'ownertaggable_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function addTaxonomyTerms($user_id, $item_id, $terms)
    {
        $items = [];
        foreach ($terms as $term) {
            $items[]['user_id'] = $user_id;
            $items[]['ownertaggable_type'] = self::INTERNAL_TYPE;
            $items[]['ownertaggable_id'] = $item_id;
            $items[]['term_id'] = $this->getOrCreateTermId($term);
        }
        return DB::table('core_folksonomy')
            ->insert($items);
    }

    public function getAllTaxonomyTerms($item_id)
    {
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('ownertaggable_type', self::INTERNAL_TYPE)
            ->where('ownertaggable_id', $item_id)
            ->get();
    }

    public function removeTaxonomyTerm($item_id, $term)
    {
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->where('ownertaggable_type', self::INTERNAL_TYPE)
            ->where('ownertaggable_id', $item_id)
            ->where('term', $term)
            ->delete();
    }

    public function removeAllTaxonomyTerms($item_id)
    {
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->where('ownertaggable_type', self::INTERNAL_TYPE)
            ->where('ownertaggable_id', $item_id)
            ->delete();
    }
}
