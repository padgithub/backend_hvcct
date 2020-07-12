<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\RequestService;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateApp()
    {
        return $this->respondSuccess($this->requestService->updateApp($_POST));
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoApp()
    {
        return $this->respondSuccess($this->requestService->infoApp($_GET));
    }

    /**
     * @param $app_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoQuestion($app_id)
    {
        //
        return $this->respondSuccess($this->requestService->infoQuestion($app_id));
    }

    /**
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoResult()
    {
        return $this->respondSuccess($this->requestService->infoResult($_POST));
    }

    /**
     * @param $app_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoScore($app_id)
    {
        return $this->respondSuccess($this->requestService->infoScore($app_id));
    }

    /**
     * @param $app_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoPhone()
    {
        $response = $this->requestService->infoPhone($_POST);
        return $response['status'] === true
            ? $this->respondSuccess([])
            : $this->respondError($response['message']);
    }


    # WEB
    public function userAll()
    {
        return $this->respondSuccess($this->requestService->getAllUser());
    }

    public function appAll()
    {
        return $this->respondSuccess($this->requestService->getAllApp());
    }

    public function scoreAll()
    {
        return $this->respondSuccess($this->requestService->getAllScore());
    }

    public function questionAll()
    {
        return $this->respondSuccess($this->requestService->getAllQuestion());
    }

    public function winAll()
    {
        return $this->respondSuccess($this->requestService->getAllWin());
    }

}
