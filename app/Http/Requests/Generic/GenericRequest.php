<?php

namespace App\Http\Requests\Generic;

use Illuminate\Foundation\Http\Request as LaravelRequest;

class GenericRequest extends LaravelRequest
{
    use ResponseTrait;
}
