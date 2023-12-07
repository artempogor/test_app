<?php

namespace App\Http\Requests\Api\Auth;

use App\Services\Auth\Params\LoginServiceParams;
use Illuminate\Foundation\Http\FormRequest;

class
LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
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

    public function toServiceParams(): LoginServiceParams
    {
        return new LoginServiceParams(
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
