<?php

namespace App\Repositories;

class Repository
{
    protected $table;
    protected $type;

    public function throwException($input = null)
    {
        //
        $message =
            count(explode($input, ' ')) === 1 || $input = ''
                ? "There was a problem " . $input . " this " . strtolower($this->type) . ". Please try again."
                : $input;

        throw new GeneralException($message);
    }
}
