<?php

namespace App\DAL\Relationships\Common;

trait UserTaggable
{
    private function getOrCreateTermId($term)
    {
        $term_id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($term_id) {
            return $term_id->id;
        }
        $term_id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $term_id->id;
    }

    public function addFolksonomyTerm($user_id, $item_id, $term)
    {
        return DB::table('core_folksonomy')
            ->insert([
                'user_id' => $user_id,
                'usertaggable_type' => self::INTERNAL_TYPE,
                'usertaggable_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function addFolksonomyTerms($user_id, $item_id, $terms)
    {
        $items = [];
        foreach ($terms as $term) {
            $items[]['user_id'] = $user_id;
            $items[]['usertaggable_type'] = self::INTERNAL_TYPE;
            $items[]['usertaggable_id'] = $item_id;
            $items[]['term_id'] = $this->getOrCreateTermId($term);
        }
        return DB::table('core_folksonomy')
            ->insert($items);
    }

    public function getAllFolksonomyTerms($item_id)
    {
        return DB::table('core_folksonomy')
            ->join('core_terms', 'core_folksonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('usertaggable_type', self::INTERNAL_TYPE)
            ->where('usertaggable_id', $item_id)
            ->get();
    }

    public function getFolksonomyTermsByUser($user_id, $item_id)
    {
        $usertaggable_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table('core_folksonomy')
            ->join('core_terms', 'core_folksonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('usertaggable_type', self::INTERNAL_TYPE)
            ->where('usertaggable_id', $item_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function removeFolksonomyTerm($user_id, $item_id, $term)
    {
        return DB::table('core_folksonomy')
            ->where('usertaggable_type', self::INTERNAL_TYPE)
            ->where('usertaggable_id', $item_id)
            ->where('user_id', $user_id)
            ->where('term', $term)
            ->delete();
    }
}
