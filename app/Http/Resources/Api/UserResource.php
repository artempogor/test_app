<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SuccessResourceTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
class UserResource extends JsonResource
{
    use SuccessResourceTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
            'created_at' => $this->resource->created_at,
        ];
    }
}
