<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Publishing\PublicationDAO;
use App\Repositories\Publishing\IssueDAO;
use App\Repositories\Publishing\ContentDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\ResponseHandler;

class MagazineController extends Controller
{
    protected $handler;
    protected $publications;
    protected $issues;
    protected $contents;

    public function __construct(
        ResponseHandler $handler,
        PublicationDAO $publications,
        ContentDAO $contents
    ) {
        $handler->setPrefix('front.blog');
        $this->handler = $handler;
        $this->publications = $publications;
        $this->contents = $contents;
    }

    public function home()
    {
    }

    public function getArticles($publication)
    {
    }

    public function getLatestIssueArticles($publication, $issue)
    {
    }

    public function getArticlesByTag($publication, $term)
    {
    }

    public function getArticlesByIssue($publication, $issue)
    {
    }

    public function getArticle($publication, $slug)
    {
    }
}
