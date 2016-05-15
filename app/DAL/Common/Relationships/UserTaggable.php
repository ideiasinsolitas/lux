<?php

namespace App\DAL\Relationships\Common;

trait UserTaggable
{
    private function getOrCreateTermId($term)
    {
        if (!is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $term_id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($term_id) {
            return $term_id->id;
        }
        $term_id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $term_id->id;
    }

    public function addFolksonomyTerm($user_id, $item_id, $term)
    {
        if (!is_int($item_id) || !is_int($item_id) || !is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
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
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $c = count($terms);
        for ($i=0; $i < $c; $i++) {
            $terms[$i]['term_id'] = $this->getOrCreateTermId($terms[$i]['name']);
            $terms[$i]['user_id'] = $user_id;
            $terms[$i]['usertaggable_type'] = self::INTERNAL_TYPE;
            $terms[$i]['usertaggable_id'] = $item_id;
        }
        return DB::table('core_folksonomy')
            ->insert($terms);
    }

    public function getAllFolksonomyTerms($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_folksonomy')
            ->join('core_terms', 'core_folksonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('usertaggable_type', self::INTERNAL_TYPE)
            ->where('usertaggable_id', $item_id)
            ->get();
    }

    public function getFolksonomyTermsByUser($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
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
        if (!is_int($user_id) || !is_int($item_id) || !is_string($term)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_folksonomy')
            ->where('usertaggable_type', self::INTERNAL_TYPE)
            ->where('usertaggable_id', $item_id)
            ->where('user_id', $user_id)
            ->where('term', $term)
            ->delete();
    }
}
