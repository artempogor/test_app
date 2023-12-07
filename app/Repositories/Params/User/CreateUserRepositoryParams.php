<?php

namespace App\Repositories\Params\User;

use App\Models\User;
use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateUserRepositoryParams extends BaseRepositoryParams
{
    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        validator($this->toArray(), [
            'name' => [
                'required',
                'string',
                'max:256'
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(
                    User::getStaticTable(),
                    'email'
                )
            ],
            'password' => [
                'required',
                'string'
            ],
        ])->validate();
    }
}
