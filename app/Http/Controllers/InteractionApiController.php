<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Interaction\InteractionDAOFactory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InteractionApiController extends Controller
{
    public function addCommment(StoreRequest $request, $entity)
    {
        $comment = $request->input(['comment']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->addComment();
    }

    public function removeCommment(StoreRequest $request, $entity)
    {
        $comment = $request->input(['comment']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->removeComment();
    }

    public function addLike(StoreRequest $request, $entity)
    {
        $like = $request->input(['like']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->like();
    }

    public function removeLike(StoreRequest $request, $entity)
    {
        $like = $request->input(['like']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->unlike();
    }

    public function addVote(StoreRequest $request, $entity)
    {
        $vote = $request->input(['vote']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->vote();
    }

    public function removeVote(StoreRequest $request, $entity)
    {
        $vote = $request->input(['vote']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->unvote();
    }

    public function addUserTag(StoreRequest $request, $entity)
    {
        $tags = $request->input(['terms']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->addFolksonomyTerms();
    }

    public function removeUserTag(StoreRequest $request, $entity)
    {
        $tag = $request->input(['term']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->removeFolksonomyTerm();
    }

    public function addOwnerTag(StoreRequest $request, $entity)
    {
        $tags = $request->input(['terms']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->addTaxonomyTerms();
    }

    public function removeOwnerTag(StoreRequest $request, $entity)
    {
        $tag = $request->input(['term']);
        $dao = InteractionDAOFactory::make($entity);
        $dao->removeTaxonomyTerm();
    }
}
