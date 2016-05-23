<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Translatable
{
    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getTranslations($item_id)
    {
        $type = DB::raw($this->type);
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('translatable_type', $type)
            ->where('translatable_id', $item_id)
            ->get();
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function addTranslation($item_id, $translationInput)
    {
        return DB::table('core_translations')
            ->update($translationInput)
            ->where('translatable_type', $this->type)
            ->where('translatable_id', $item_id);
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function removeTranslation($item_id)
    {
        return DB::table('core_translations')
            ->where('tranlatable_type', $this->type)
            ->where('translatable_id', $item_id)
            ->delete();
    }

    /**
     * /
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function generateSlug($string)
    {
        if (!is_string($string)) {
            throw new \Exception("Invalid input type", 1);
        }

        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);

        if (empty($string)) {
            $slug = 'n-a';
        }

        $slug = $string;
        $i = 1;
        $slugTpl = $slug . '-';
        while ($this->typeNotUnique($slug)) {
            $slug = $slugTpl . $i;
            $i++;
        }
        return $slug;
    }

    /**
     * /
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function isSlugUnique($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Invalid input type", 1);
        }

        return DB::table('translations')->select('id')->where('slug', $slug) ? true : false;
    }
}
