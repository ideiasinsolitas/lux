<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Metadata
{
    /**
     * /
     * @param Record $record [description]
     */
    public function addMeta(Record $record)
    {
        $sql = "INSERT INTO metadata (item_name, item_id, key, value) VALUES (:item_name, :item_id, :key, :value)";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function updateMeta(Record $record)
    {
        $sql = "UPDATE metadata SET value=:value, order=:order WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function removeMeta(Record $record)
    {
        $sql = "DELETE FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    /**
     * /
     * @param  [type] $item_name [description]
     * @param  [type] $item_id   [description]
     * @param  [type] $key       [description]
     * @return [type]            [description]
     */
    public function getMeta($item_name, $item_id, $key)
    {
        $sql = "SELECT id, item_name, item_id, key, value FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    /**
     * /
     * @param  [type] $item_name [description]
     * @param  [type] $item_id   [description]
     * @return [type]            [description]
     */
    public function getAllMeta($item_name, $item_id)
    {
        $sql = "SELECT id, item_name, item_id, key, value FROM metadata";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_name));
        return $result;
    }
}
