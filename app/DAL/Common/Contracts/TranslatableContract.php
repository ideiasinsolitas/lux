<?php

namespace App\DAL\Common\Contract;

interface TranslatableContract
{
    public function addTranslation($item_id, $lang, array $input);

    public function updateTranslation($item_id, $lang, array $input);

    public function getAllTranslations($item_id);

    public function getTranslation($item_id, $lang);

    public function getSlug($item_id, $lang);

    public function getTranslationBySlug($slug);

    public function removeTranslation($item_id, $lang);

    public function generateSlug($string);

    public function slugExists($slug);
}
