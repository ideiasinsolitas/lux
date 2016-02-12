<?php

namespace App\Repositories\Relationships\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Translatable
{
    public function handleTranslationInput($input)
    {
        return array_filter(
            $input,
            function ($v) {
                return in_array($v, [
                        'name',
                        'description',
                        'title',
                        'subtitle',
                        'tagline',
                        'excerpt',
                        'body',
                    ]);
            }
        );
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function addTranslation($item_id, $lang, $input)
    {
        $translationInput = $this->handleTranslationInput($input);
        if ($translationInput) {
            $translationInput['lang'] = $lang;
            $translationInput['translatable_type'] = $this->type;
            $translationInput['translatable_id'] = $item_id;
            return DB::table('core_translations')
                ->insert($translationInput);
        }
        return false;
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function updateTranslation($item_id, $lang, $input)
    {
        $translationInput = $this->handleTranslationInput($input);
        if ($translationInput) {
            $translationInput['lang'] = $lang;
            $translationInput['translatable_type'] = $this->type;
            $translationInput['translatable_id'] = $item_id;
            return DB::table('core_translations')
                ->update($translationInput)
                ->where('translatable_type', $this->type)
                ->where('translatable_id', $item_id)
                ->where('lang', $lang);
        }
        return false;
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getAllTranslations($item_id)
    {
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('translatable_type', $translatable_type)
            ->where('translatable_id', $item_id)
            ->get();
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getTranslation($item_id, $lang)
    {
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('translatable_type', $translatable_type)
            ->where('translatable_id', $item_id)
            ->where('lang', $lang)
            ->get();
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getSlug($item_id, $lang)
    {
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('slug')
            ->where('translatable_type', $translatable_type)
            ->where('translatable_id', $item_id)
            ->where('lang', $lang)
            ->get();
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getTranslationBySlug($slug)
    {
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('slug', $slug)
            ->get();
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function removeTranslation($item_id, $lang)
    {
        return DB::table('core_translations')
            ->where('tranlatable_type', $this->type)
            ->where('translatable_id', $item_id)
            ->where('lang', $lang)
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
