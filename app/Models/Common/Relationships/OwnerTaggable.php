<?php

namespace App\Models\Relationships\Common;

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
        $ownertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_taxonomy')
            ->insert([
                'ownertaggable_type' => $ownertaggable_type,
                'ownertaggable_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function addTaxonomyTerms($user_id, $item_id, $terms)
    {
        $ownertaggable_type = DB::raw('\"' . $this->type . '\"');
        $items = [];
        foreach ($terms as $term) {
            $items[]['user_id'] = $user_id;
            $items[]['ownertaggable_type'] = $this->type;
            $items[]['ownertaggable_id'] = $item_id;
            $items[]['term_id'] = $this->getOrCreateTermId($term);
        }
        return DB::table('core_folksonomy')
            ->insert($items);
    }

    public function getAllTaxonomyTerms($item_id)
    {
        $ownertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('ownertaggable_type', $this->type)
            ->where('ownertaggable_id', $item_id)
            ->get();
    }

    public function removeTaxonomyTerm($item_id, $term)
    {
        $ownertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->where('ownertaggable_type', $this->type)
            ->where('ownertaggable_id', $ownertaggable_id)
            ->where('term', $term)
            ->delete();
    }
}
