<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\NotifyService;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    protected $notifyService;

    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    public function store(Request $request)
    {
        return $this->respondSuccess($this->notifyService->store($request));
    }
}
