<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        //
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->respondSuccess($this->userService->index());
    }

    public function get_name()
    {
        return $this->respondSuccess($this->userService->get_name());
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return $this->respondSuccess($this->userService->show($id));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->respondSuccess($this->userService->update($request, $id));
    }

    public function destroy($id)
    {
        return $this->respondSuccess($this->userService->destroy($id));
    }

}
