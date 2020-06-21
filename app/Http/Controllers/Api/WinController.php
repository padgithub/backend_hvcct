<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\WinService;

class WinController extends Controller
{
    protected $winService;

    public function __construct(WinService $winService)
    {
        //
        $this->winService = $winService;
    }

    public function index()
    {
        //
        return $this->respondSuccess($this->winService->index());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->respondSuccess($this->winService->store($request));
    }

    public function show($id)
    {
        return $this->respondSuccess($this->winService->show($id));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->respondSuccess($this->winService->update($request, $id));
    }

    public function destroy($id)
    {
        return $this->respondSuccess($this->winService->destroy($id));
    }

}
