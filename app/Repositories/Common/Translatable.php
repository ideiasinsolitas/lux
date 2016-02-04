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
        if (!is_int($item_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        return DB::table('translations')
            ->select('id', 'slug', 'name', 'title', 'subtitle', 'tagline', 'excerpt', 'description', 'body', 'language')
            ->where('translatable_type', $this->slug)
            ->where('translatable_id', $item_id)
            ->get();
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function addTranslation($id, $input)
    {
        return $result;
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function removeTranslation($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "DELETE FROM translations WHERE item_name=:item_name, item_id=:item_id";
        $result = $this->db->run($sql, array('item_name' => $this->slug,'item_id' => $item_id));
        return $result;
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
        while ($this->slugNotUnique($slug)) {
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
    private function isSlugUnique($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Invalid input type", 1);
        }

        return DB::table('translations')->select('id')->where('slug', $slug) ? true : false;
    }
}
