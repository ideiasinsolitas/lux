<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Sys\Contracts\FileDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Services\Rest\RestProcessorContract;

class UploadController extends Controller
{
    protected $rest;
    
    protected $files;

    public function __construct(RestProcessorContract $rest, FileDAOContract $files)
    {
        $this->rest = $rest;
        $this->files = $files;
    }
}
