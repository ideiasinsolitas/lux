<?php

namespace App\DAL\Features;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait DAOSoftDeleteTrait
{
    public function trash($id)
    {
        return DB::table(self::TABLE)->where(self::PK, $id)->update([self::TABLE . '.deleted' => Carbon::now()]);
    }

    public function restore($id)
    {
        return DB::table(self::TABLE)->where(self::PK, $id)->update([self::TABLE . '.deleted' => null]);
    }

    public function findTrashed()
    {
        return DB::table(self::TABLE)->where(self::PK, $id)->where(self::TABLE . '.deleted', '!=', null)->get();
    }

    public function find()
    {
        return $this->getBuilder()->get();
    }

    public function findPaginated($per_page)
    {
        return $this->getBuilder()
            ->where(self::TABLE . '.deleted', '!=', null)
            ->paginate($per_page);
    }

    public function findOne($id)
    {
        return $this->getBuilder()
            ->where(self::TABLE . '.' . self::PK, $id)
            ->where(self::TABLE . '.deleted', '!=', null)
            ->get();
    }
}
