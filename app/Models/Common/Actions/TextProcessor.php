<?php

namespace Models\Common;

use App\Services\TextProcessor\TextProcessorContract;

trait TextProcessor
{
    protected $textProcessor;
    
    public function setTextProcessor(TextProcessorContract $processor)
    {
        $this->textProcessor = $processor;
    }

    public function processText($data)
    {
        if (!empty($this->textProcessor)) {
            return $this->textProcessor->process($data);
        }
        return $data;
    }
}
