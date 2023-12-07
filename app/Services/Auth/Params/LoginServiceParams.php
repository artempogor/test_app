<?php

namespace App\Services\Auth\Params;

class LoginServiceParams
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}