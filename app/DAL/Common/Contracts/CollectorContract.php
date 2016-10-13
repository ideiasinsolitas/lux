<?php

namespace App\DAL\Common\Contract;

interface CollectorContract extends CollectionAwareContract
{
    public function createCollection($item_id);

    public function removeCollection($collection_id, $item_id);

    public function getCollections($item_id);
}
