<?php

namespace App\Http\Requests\Api\Auth;

use App\Services\Auth\Params\RegisterServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="RegistrationRequest",
 *      description="Registration request body",
 *      required={"name,email,password"},
 *      type="object",
 *   @OA\Property(property="name", type="string", example="Игорь Охота",maximum=100),
 *   @OA\Property(property="email", type="string", example="igor@gmail.com",maximum=100),
 *   @OA\Property(property="password", type="string", example="password123",maximum=100),
 * ),
 */
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
