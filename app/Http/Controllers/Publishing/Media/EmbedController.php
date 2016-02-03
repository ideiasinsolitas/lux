<?php

namespace App\Http\Controllers\Publishing\Media\Embed;

use App\Repositories\Publishing\Media\EmbedRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class EmbedController extends Controller
{
    protected $embeds;

    public function __construct(EmbedRepository $embeds)
    {
        $this->embeds = $embeds;
    }

    public function index($page = 1)
    {

    }

    public function create(CreateRequest $request)
    {

    }

    public function store(StoreRequest $request)
    {

    }

    public function edit($id, EditRequest $request)
    {
    
        
    }

    public function update($id, UpdateRequest $request)
    {
    
    }

    public function destroy($id, DeleteRequest $request)
    {
    
    }

    public function deleteMany(DeleteRequest $request)
    {
    
    }

    public function delete($id, PermanentlyDeleteRequest $request)
    {

    }
}
