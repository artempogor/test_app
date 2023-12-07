<?php

namespace App\Http\Requests\Api\Auth;

use App\Services\Auth\Params\RegisterServiceParams;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:256'
            ],
            'email' => [
                'required',
                'string',
                'email'
            ],
            'password' => [
                'required',
                'string'
            ],
        ];
    }

    public function toServiceParams(): RegisterServiceParams
    {
        return new RegisterServiceParams(
            name: $this->get('name'),
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
