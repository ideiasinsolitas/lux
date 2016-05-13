<?php

namespace App\Models\Relationships\Common;

trait Translatable
{
    public function handleTranslationInput($input)
    {
        $input = array_filter(
            $input,
            function ($k, $v) {
                return in_array($k, [
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
        return $input;
    }

    public function addTranslation($item_id, $lang, array $input)
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

    public function updateTranslation($item_id, $lang, array $input)
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

    public function getAllTranslations($item_id)
    {
        if (!property_exists($this, 'type')) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('translatable_type', $translatable_type)
            ->where('translatable_id', $item_id)
            ->get();
    }

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

    public function getTranslationBySlug($slug)
    {
        $translatable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('slug', $slug)
            ->get();
    }

    public function removeTranslation($item_id, $lang)
    {
        return DB::table('core_translations')
            ->where('tranlatable_type', $this->type)
            ->where('translatable_id', $item_id)
            ->where('lang', $lang)
            ->delete();
    }

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
        while ($this->slugExists($slug)) {
            $slug = $slugTpl . $i;
            $i++;
        }
        return $slug;
    }

    public function slugExists($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Invalid input type", 1);
        }

        return DB::table('translations')->select('id')->where('slug', $slug) ? true : false;
    }
}
