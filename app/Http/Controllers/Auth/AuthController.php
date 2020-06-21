<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;
use App\Model\Users;
use App\Service\RequestService;

class AuthController extends Controller
{

    protected $requestService;

    public function __construct(RequestService $requestService)
    {
//        $this->middleware('auth:api', ['except' => ['login']]);
        $this->requestService = $requestService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $input = request()->all();
        $credentials = [
            'fb_email'  => $input['fb_email'],
            'password'  => $input['password'],
        ];
        $token = Auth::attempt($credentials);
        if (!empty($token)) {
            return $this->respondWithToken($token);
        }
        return $this->respondError('Email or Password is wrong');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->respondSuccess(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->factory()->getTTL() * (60*2)
        ]);
    }
}
