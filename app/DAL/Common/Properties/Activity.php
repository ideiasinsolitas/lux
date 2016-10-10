<?php

namespace App\DAL\Common\Properties;

trait Activity
{
    protected $activity;

    public function setActivity($value)
    {
        $this->activity = $value;
    }

    public function getActivity()
    {
        return $this->activity;
    }
}
