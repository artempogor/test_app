<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JwtResource extends JsonResource
{
    use SuccessResourceTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;

        return [
            'access_token' => $resource->getAccessToken(),
            'token_type' => $resource->getTokenType(),
            'expire_in' => $resource->getExpireIn(),
        ];
    }
}
