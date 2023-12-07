<?php

namespace App\Services\Auth\Params;

use App\Repositories\Params\User\CreateUserRepositoryParams;
use Illuminate\Support\Facades\Hash;

class RegisterServiceParams
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }

    public function toRepositoryParams(): CreateUserRepositoryParams
    {
        return new CreateUserRepositoryParams([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }
}