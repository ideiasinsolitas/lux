<?php

namespace App\DAL\Common\Contract;

interface NodableContract
{
    public function createNode();

    public function getOneByNodeId($node_id);
}
