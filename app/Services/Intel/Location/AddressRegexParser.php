<?php

namespace App\Services\Location;

class AddressRegexParser
{
    protected $pattern;

    protected $matches;

    public function __construct()
    {
        $this->pattern = "";
    }

    public function parse($text)
    {
        preg_match_all($this->pattern, $text, $this->matches);
    }

    public function getMatches()
    {
        return $this->matches;
    }
}
