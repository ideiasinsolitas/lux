<?php

namespace App\DAL\Common\Contract;

interface CollectableContract extends CollectionAwareContract
{
    public function addToCollection($collection_id, $item_id, $order);

    public function removeFromCollection($collection_id, $item_id);

    public function clearCollection($collection_id);
}
