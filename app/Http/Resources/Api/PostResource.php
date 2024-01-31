<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SuccessResourceTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @property Post $resource
 *
 * @OA\Schema(
 *   schema="PostResource",
 *   title="Post",
 *   description="Post model",
 *
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     example="1",
 *     description="ID of the post"
 *   ),
 *   @OA\Property(
 *     property="topic",
 *     type="string",
 *     description="Тема поста",
 *     example="Охота и рыбалка"
 *   ),
 )
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Заголовок поста",
 *     example="Охота на медведей"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string",
 *     description="Content of the post",
 *     example="При охоте на медведей нужно учесть несколько важных моментов..."
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     description="Date and time when the post was created",
 *     example="2022-01-01T12:00:00Z"
 *   ),
 *   @OA\Property(
 *     property="publish_at",
 *     type="string",
 *     format="date-time",
 *     description="Date and time when the post was last updated",
 *     example="2022-01-01T13:00:00Z"
 *   )
 * )
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
