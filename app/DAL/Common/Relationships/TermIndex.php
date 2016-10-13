<?php

namespace App\DAL\Common\Relationships;

trait TermIndex
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
}
