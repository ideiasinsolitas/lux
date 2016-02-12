<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Publishing\PublicationRepository;
use App\Repositories\Publishing\IssueRepository;
use App\Repositories\Publishing\ContentRepository;

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
        PublicationRepository $publications,
        ContentRepository $contents
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
