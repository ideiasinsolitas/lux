<?php

namespace App\DAL\Common\Contract;

interface NodableContract
{
    const NODE_TABLE = 'core_nodes';

    const NODE_FK = 'node_id';

    public function createNode();

    public function getOneByNodeId($node_id);
}
