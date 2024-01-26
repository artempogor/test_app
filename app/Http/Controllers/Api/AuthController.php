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
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    public function __construct(
        protected readonly RegisterService $registerService,
        protected readonly LoginService    $loginService,
        protected readonly RefreshService  $refreshService
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Auth"},
     *     summary="Регистрация нового пользователя",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/RegistrationRequest")
     *              }
     *          )
     *      ),
     *  @OA\Response(response="201", description="Пользователь зарегистрирован"),
     *  @OA\Response(response="422", description="Ошибка валидации")
     * )
     */
    public function register(RegistrationRequest $request): JwtResource
    {
        $response = $this->registerService->register($request->toServiceParams());

        return JwtResource::make($response);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="Авторизация пользователя",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Пароль пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="Пользователь авторизован"),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     */
    public function login(LoginRequest $request): JwtResource
    {
        $response = $this->loginService->login($request->toServiceParams());

        return JwtResource::make($response);
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/logout",
     *     summary="Выход",
     *     security={{"bearerAuth":{}}},
     *  @OA\Response(response="201", description="Выход выполнен"),
     * )
     **/
    public function logout(): SuccessResource
    {
        Auth::logout();

        return SuccessResource::empty();
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/refresh",
     *     security={{"bearerAuth":{}}},
     *     summary="Обновление токена",
     *  @OA\Response(response="201", description="Обновление токена авторизации"),
     * )
     **/
    public function refresh(): JwtResource
    {
        $response = $this->refreshService->refresh();

        return JwtResource::make($response);
    }
}