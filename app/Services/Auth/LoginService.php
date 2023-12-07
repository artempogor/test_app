<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use App\Services\Auth\Params\LoginServiceParams;
use App\Services\Auth\Responses\JwtResponse;
use RuntimeException;

class LoginService
{
    public function __construct(
        protected readonly UserRepository $userRepository,
    )
    {
    }

    public function login(LoginServiceParams $params): JwtResponse
    {
        $token = auth()->attempt([
            'email' => $params->email,
            'password' => $params->password,
        ]);

        if (!$token) {
            throw new RuntimeException('Неверный логин или пароль');
        }

        return new JwtResponse(
            $token,
            'bearer',
            auth()->factory('api')->getTTL() * 60
        );
    }
}