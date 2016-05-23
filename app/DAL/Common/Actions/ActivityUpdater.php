<?php

namespace App\DAL\Common\Actions;

trait ActivityUpdater
{
    public function getActivity($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $builder = DB::table(self::TABLE)
            ->select('activity')
            ->where(self::PK, $pk)
            ->first();
    }

    public function mark($pk, $activity)
    {
        if (!is_int($pk) || !is_int($activity)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update(['activity' => $activity]);
    }

    public function deactivate($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->mark($pk, 1);
    }

    public function activate($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->mark($pk, 2);
    }

    public function demote($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $old = $this->getActivity($pk)->pk;
        $activity = $old - 1;
        $activity = $activity < 0 ? 0 : $activity;
        return $this->mark($pk, $activity);
    }

    public function promote($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $old = $this->getActivity($pk)->pk;
        $activity = $old + 1;
        return $this->mark($pk, $activity);
    }
}
