<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ScoreService;

class ScoreController extends Controller
{
    protected $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        //
        $this->scoreService = $scoreService;
    }

    public function index()
    {
        //
        return $this->respondSuccess($this->scoreService->index());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->respondSuccess($this->scoreService->store($request));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->respondSuccess($this->scoreService->update($request, $id));
    }

    public function destroy($id)
    {
        return $this->respondSuccess($this->scoreService->destroy($id));
    }

}
