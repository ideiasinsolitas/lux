<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Publishing\PublicationDAO;
use App\Repositories\Publishing\ContentDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\ResponseHandler;

class BlogController extends Controller
{
    protected $publications;
    protected $contents;
    protected $handler;

    public function __construct(ResponseHandler $handler, PublicationDAO $publications, ContentDAO $contents)
    {
        $handler->setPrefix('front.blog');
        $this->handler = $handler;
        $this->publications = $publications;
        $this->contents = $contents;
    }

    public function blogs()
    {
    }

    public function home($publication)
    {
    }

    public function posts($publication)
    {
    }

    public function tagArchive($publication, $term)
    {
    }

    public function categoryArchive($publication, $term)
    {
    }

    public function monthArchive($publication, $month)
    {
    }

    public function yearArchive($publication, $year)
    {
    }

    public function show($publication, $slug)
    {
    }
}
