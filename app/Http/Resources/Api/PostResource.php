<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SuccessResourceTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Post $resource
 */
class PostResource extends JsonResource
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
            'topic' => $this->resource->topic,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'created_at' => $this->resource->created_at,
            'publish_at' => $this->resource->published_at,
        ];
    }
}
