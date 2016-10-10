<?php

namespace App\DAL\Common\Relationships;

use Illuminate\Support\Facades\DB;

trait Translatable
{
    protected function handleTranslationInput($input)
    {
        return array_filter(
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
    }

    public function addTranslation($item_id, $lang, array $input)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $translationInput = $this->handleTranslationInput($input);
        if (!$translationInput) {
            throw new \Exception("Error Processing Request", 1);
        }

        $translationInput['lang'] = $lang;
        $translationInput['translatable_type'] = self::INTERNAL_TYPE;
        $translationInput['translatable_id'] = $item_id;
        return DB::table('core_translations')
            ->insert($translationInput);
    }

    public function updateTranslation($item_id, $lang, array $input)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $translationInput = $this->handleTranslationInput($input);
        if (!$translationInput) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table('core_translations')
            ->update($translationInput)
            ->where('core_translations.translatable_type', self::INTERNAL_TYPE)
            ->where('core_translations.translatable_id', $item_id)
            ->where('core_translations.lang', $lang);
    }

    protected function getTranslationBuilder()
    {
        return DB::table('core_translations')
            ->select(
                'core_translations.id',
                'core_translations.slug',
                'core_translations.name',
                'core_translations.title',
                'core_translations.subtitle',
                'core_translations.tagline',
                'core_translations.excerpt',
                'core_translations.description',
                'core_translations.body',
                'core_translations.language'
            );
    }

    public function getAllTranslations($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->getTranslationBuilder()
            ->where('core_translations.translatable_type', self::INTERNAL_TYPE)
            ->where('core_translations.translatable_id', $item_id)
            ->get();
    }

    public function getTranslation($item_id, $lang)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->getTranslationBuilder()
            ->where('translatable_type', self::INTERNAL_TYPE)
            ->where('translatable_id', $item_id)
            ->where('lang', $lang)
            ->get();
    }

    public function getSlug($item_id, $lang)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table('core_translations')
            ->select('core_translations.slug')
            ->where('core_translations.translatable_type', self::INTERNAL_TYPE)
            ->where('core_translations.translatable_id', $item_id)
            ->where('core_translations.lang', $lang)
            ->get();
    }

    public function getTranslationBySlug($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return $this->getTranslationBuilder()
            ->where('core_translationsslug', $slug)
            ->get();
    }

    public function removeTranslation($item_id, $lang)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $translatable_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table('core_translations')
            ->where('tranlatable_type', self::INTERNAL_TYPE)
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
            throw new \Exception("Could not generate slug.", 1);
        }

        $i = 1;
        $slug = $string . '-';
        while ($this->slugExists($slug)) {
            $slug .= $i;
            $i++;
        }

        return $slug;
    }

    protected function slugExists($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Invalid input type", 1);
        }

        return DB::table('translations')->select('id')->where('slug', $slug)->first() ? true : false;
    }
}
