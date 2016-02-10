<?php

namespace App\Repositories\Common;

use Illuminate\Support\Facades\DB;

trait Builder
{
    public function getBuilder()
    {
        $table = DB::raw($this->mainTable . ' AS main');
        $builder = DB::table($table);

        return $builder;
    }

    public function build($builder = null)
    {
        $builder = $builder || $this->getBuilder();

        if (method_exists($this, 'buildTyped')) {
            $builder = $this->buildTyped($builder);
        }
        if (method_exists($this, 'buildTranslatable')) {
            $builder = $this->buildTranslatable($builder);
        }
        if (method_exists($this, 'buildLikeable')) {
            $builder = $this->buildLikeable($builder);
        }
        if (method_exists($this, 'buildVotable')) {
            $builder = $this->buildVotable($builder);
        }
        if (method_exists($this, 'buildOwner')) {
            $builder = $this->buildOwner($builder);
        }

        return $builder;
    }
}
