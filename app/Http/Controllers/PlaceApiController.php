<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PlaceApiController extends Controller
{
    protected $dao;

    public function __construct(PlaceDAOContract $dao)
    {
        $this->dao = $dao;
    }

    public function fillAddress(Request $request)
    {
    }
}
