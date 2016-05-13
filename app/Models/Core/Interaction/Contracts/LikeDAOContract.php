<?php

namespace App\Core\Interaction\Contracts;

interface LikeDAOContract
{
    const TABLE = "core_likes";

    const PK = "user_id";

    public function create(array $input);

    public function update(array $input, $pk);

    public function delete($id);

    public function getAll(array $filters = array());
}
