<?php

namespace App\Services\TextProcessor;

class OutputProcessor implements TextProcessorContract
{
    public function process(array $data)
    {
        $processed = [];
        foreach ($data as $key => $value) {
            method_exists($this, $key)
                ? $processed[$key] = $this->$key($value)
                : $processed[$key] = $value;
        }
        return $processed;
    }

    private function name($name)
    {
        return $name;
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
}
