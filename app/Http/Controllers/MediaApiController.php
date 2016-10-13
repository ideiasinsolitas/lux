<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Sys\Contracts\FileDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Services\Rest\RestProcessorContract;

class MediaApiController extends Controller
{
    protected $files;

    public function __construct(FileDataMapperContract $files)
    {
        $this->files = $files;
    }

    public function upload()
    {

    }
}
