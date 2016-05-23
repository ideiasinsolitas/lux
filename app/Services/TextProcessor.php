<?php

namespace App\Services;

class TextProcessor
{
    public $processed;

    public function __construct($input)
    {
        $this->processed = $this->process($input);
    }

    private function process($input)
    {
        $processed = [];
        foreach ($input as $key => $value) {
            method_exists($this, $key)
                ? $processed[$key] = $this->$key($value)
                : null;
        }
        return $processed;
    }

    private function name($name)
    {
        return ucfirst(strtolower($name));
    }

    private function description($description)
    {
        return $description;
    }

    private function title($title)
    {
        return $title;
    }

    private function subtitle($subtitle)
    {
        return $subtitle;
    }

    private function tagline($tagline)
    {
        return $tagline;
    }

    private function excerpt($excerpt)
    {
        return $excerpt;
    }

    private function body($body)
    {
        return $body;
    }

    public function __toString()
    {
        return json_encode($this->processed);
    }
}
