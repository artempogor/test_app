<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Auth\Params\RegisterServiceParams;
use App\Services\Auth\Responses\JwtResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class RegisterService
{
    public function __construct(
        protected readonly UserRepository $userRepository,
    )
    {
    }

    public function register(RegisterServiceParams $params): JwtResponse
    {
        /** @var User $user */
        $user = $this->userRepository->create($params->toRepositoryParams());

        auth()->login($user);

        return new JwtResponse(
            JWTAuth::fromUser($user),
            'bearer',
            auth()->factory('api')->getTTL() * 60
        );
    }
}