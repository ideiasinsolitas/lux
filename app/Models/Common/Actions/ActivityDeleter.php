<?php

namespace App\Repositories\Actions\Common;

use Carbon\Carbon;

trait ActivityDeleter
{
    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        return DB::table($this->table)
            ->update(['activity' => 0, 'deleted' => Carbon::now()])
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteMany($ids)
    {
        return DB::table($this->table)
            ->update(['activity' => 0, 'deleted' => Carbon::now()])
            ->whereIn('id', $ids);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function restore($id)
    {
        return DB::table($this->table)
            ->update(['activity' => 1, 'deleted' => null])
            ->whereIn('id', $ids);
    }
}
