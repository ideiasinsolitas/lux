<?php

namespace App\Validation;

class ProjectValidation
{
    public function __construct($input)
    {
        $this->input = $input;
    }

    protected function getProjectValidator()
    {
        $validator = Validator::make($this->input, [
            '' => 'email|unique:users',
        ]);
    }

    protected function getCommentValidator()
    {
        $validator = Validator::make($this->input, [
            '' => 'email|unique:users',
        ]);
    }

    protected function getTicketValidator()
    {
        $validator = Validator::make($this->input, [
            '' => 'email|unique:users',
        ]);
    }
}
