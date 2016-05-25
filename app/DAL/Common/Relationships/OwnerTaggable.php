<?php

namespace App\DAL\Common\Relationships;

trait OwnerTaggable
{
    public function getOrCreateTermId($term)
    {
        if (!is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $term_id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($term_id) {
            return $term_id->id;
        }
        $term_id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $term_id;
    }

    public function addTaxonomyTerm($item_id, $term)
    {
        if (!is_int($item_id) || !is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_taxonomy')
            ->insert([
                'ownertaggable_type' => self::INTERNAL_TYPE,
                'ownertaggable_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function addTaxonomyTerms($user_id, $item_id, array $terms)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $c = count($terms);
        for ($i=0; $i < $c; $i++) {
            $terms[$i]['term_id'] = $this->getOrCreateTermId($terms[$i]['name']);
            $terms[$i]['user_id'] = $user_id;
            $terms[$i]['ownertaggable_type'] = self::INTERNAL_TYPE;
            $terms[$i]['ownertaggable_id'] = $item_id;
        }
        return DB::table('core_folksonomy')
            ->insert($terms);
    }

    public function getAllTaxonomyTerms($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('core_taxonomy.ownertaggable_type', self::INTERNAL_TYPE)
            ->where('core_taxonomy.ownertaggable_id', $item_id)
            ->get();
    }

    public function removeTaxonomyTerm($item_id, $term)
    {
        if (!is_int($item_id) || !is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->where('core_taxonomy.ownertaggable_type', self::INTERNAL_TYPE)
            ->where('core_taxonomy.ownertaggable_id', $item_id)
            ->where('core_terms.term', $term)
            ->delete();
    }

    public function removeAllTaxonomyTerms($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_taxonomy')
            ->join('core_terms', 'core_taxonomy.term_id', 'core_terms.id')
            ->where('core_taxonomy.ownertaggable_type', self::INTERNAL_TYPE)
            ->where('core_taxonomy.ownertaggable_id', $item_id)
            ->delete();
    }
}
