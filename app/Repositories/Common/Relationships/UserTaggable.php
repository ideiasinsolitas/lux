<?php

namespace App\Repositories\Relationships\Common;

trait UserTaggable
{
    private function getOrCreateTermId($term)
    {
        $id = DB::table('core_terms')->select('id')->where('name', $term);
        if ($id) {
            return $id;
        }
        $id = DB::table('core_terms')->insertGetId(['name' => $term]);
        return $id;
    }

    public function addFolksonomyTerm($user_id, $item_id, $term)
    {
        $usertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_folksonomy')
            ->insert([
                'user_id' => $user_id,
                'usertaggable_type' => $usertaggable_type,
                'usertaggable_id' => $item_id,
                'term_id' => $this->getOrCreateTermId($term)
            ]);
    }

    public function addFolksonomyTerms($user_id, $item_id, $terms)
    {
        $usertaggable_type = DB::raw('\"' . $this->type . '\"');
        $items = [];
        foreach ($terms as $term) {
            $items[]['user_id'] = $user_id;
            $items[]['usertaggable_type'] = $usertaggable_type;
            $items[]['usertaggable_id'] = $item_id;
            $items[]['term_id'] = $this->getOrCreateTermId($term);
        }
        return DB::table('core_folksonomy')
            ->insert($items);
    }

    public function getAllFolksonomyTerms($item_id)
    {
        $usertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_folksonomy')
            ->join('core_terms', 'core_folksonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('usertaggable_type', $usertaggable_type)
            ->where('usertaggable_id', $item_id)
            ->get();
    }

    public function getFolksonomyTermsByUser($user_id, $item_id)
    {
        $usertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_folksonomy')
            ->join('core_terms', 'core_folksonomy.term_id', 'core_terms.id')
            ->select('core_terms.name', 'core_terms.id')
            ->where('usertaggable_type', $usertaggable_type)
            ->where('usertaggable_id', $item_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function removeFolksonomyTerm($user_id, $item_id, $term)
    {
        $usertaggable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_folksonomy')
            ->where('usertaggable_type', $usertaggable_type)
            ->where('usertaggable_id', $usertaggable_id)
            ->where('user_id', $user_id)
            ->where('term', $term)
            ->delete();
    }
}
