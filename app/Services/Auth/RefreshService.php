<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use App\Services\Auth\Responses\JwtResponse;
use Illuminate\Support\Facades\Auth;

class RefreshService
{
    public function __construct(
        protected readonly UserRepository $userRepository,
    )
    {
    }

    public function refresh(): JwtResponse
    {
        return new JwtResponse(
            Auth::refresh(),
            'bearer',
            auth()->factory('api')->getTTL() * 60
        );
    }
}