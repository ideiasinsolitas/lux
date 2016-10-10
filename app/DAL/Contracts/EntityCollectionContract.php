<?php

namespace App\DAL\Contracts;

interface EntityCollectionContract
{
    public function push();

    public function all();
}
