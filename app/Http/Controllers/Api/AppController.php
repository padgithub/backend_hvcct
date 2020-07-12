<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\AppService;

class AppController extends Controller
{
    protected $appService;

    public function __construct(AppService $appService)
    {
        //
        $this->appService = $appService;
    }

    public function index()
    {
        //
        return $this->respondSuccess($this->appService->index());
    }

    public function get_name()
    {
        return $this->respondSuccess($this->appService->get_name());
    }

    public function store(Request $request)
    {
        return $this->respondSuccess($this->appService->store($request));
    }

    public function show($id)
    {
        return $this->respondSuccess($this->appService->show($id));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->respondSuccess($this->appService->update($request, $id));
    }

    public function destroy($id)
    {
        return $this->respondSuccess($this->appService->destroy($id));
    }

}
