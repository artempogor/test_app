<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Resources\JwtResource;
use App\Http\Resources\SuccessResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\RefreshService;
use App\Services\Auth\RegisterService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        protected readonly RegisterService $registerService,
        protected readonly LoginService    $loginService,
        protected readonly RefreshService  $refreshService
    )
    {
    }

    public function register(RegistrationRequest $request): JwtResource
    {
        $response = $this->registerService->register($request->toServiceParams());

        return JwtResource::make($response);
    }

    public function login(LoginRequest $request): JwtResource
    {
        $response = $this->loginService->login($request->toServiceParams());

        return JwtResource::make($response);
    }

    public function logout(): SuccessResource
    {
        Auth::logout();

        return SuccessResource::empty();
    }

    public function refresh(): JwtResource
    {
        $response = $this->refreshService->refresh();

        return JwtResource::make($response);
    }
}