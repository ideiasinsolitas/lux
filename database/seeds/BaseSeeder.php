<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class BaseSeeder extends Seeder
{
    public function getNodeTemplate()
    {
        $node_template = [
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
            'activity' => 1,
        ];
        return $node_template;
    }

    public function getCollectionTemplate()
    {
        return [];
    }

    public function getResourceTemplate()
    {
        return [];
    }
}
