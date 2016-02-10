<?php

namespace App\Repositories;

class Repository
{
    protected $modelNamespace;
    protected $mainTable;
    protected $modelSlug;

    public function throwException()
    {
        //
        $message =
            count(explode($input, ' ')) === 1 || $input = ''
                ? "There was a problem " . $input . " this " . strtolower($this->type) . ". Please try again."
                : $input;

        throw new GeneralException($message);
    }
}
