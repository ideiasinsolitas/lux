<?php

namespace App\DAL\Common\Contract;

interface OwnerTaggableContract
{
    public function getOrCreateTermId($term);

    public function addTaxonomyTerm($item_id, $term);

    public function addTaxonomyTerms($user_id, $item_id, array $terms);

    public function getAllTaxonomyTerms($item_id);

    public function removeTaxonomyTerm($item_id, $term);

    public function removeAllTaxonomyTerms($item_id);
}
