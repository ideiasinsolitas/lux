<?php

namespace App\Models\Actions\Common;

trait ActivityUpdater
{
    public function getActivity($pk)
    {
        $builder = DB::table(self::TABLE)
            ->select('activity')
            ->where(self::PK, $pk)
            ->first();
    }

    public function mark($pk, $activity)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update(['activity' => $activity]);
    }

    public function deactivate($pk)
    {
        $this->mark($pk, 1);
    }

    public function activate($pk)
    {
        $this->mark($pk, 2);
    }

    public function demote($pk)
    {
        $old = $this->getActivity($pk)->pk;
        $activity = $old - 1;
        $activity = $activity < 0 ? 0 : $activity;
        $this->mark($pk, $activity);
    }

    public function promote($pk)
    {
        $old = $this->getActivity($pk)->pk;
        $activity = $old + 1;
        $this->mark($pk, $activity);
    }
}
