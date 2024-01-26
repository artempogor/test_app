<?php

namespace App\Http\Requests\Api\Post;

use App\Services\Post\Params\PostCreateServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="PostCreateRequest",
 *      description="Post create request body",
 *      required={"topic,title,content,published_at"},
 *      type="object",
 *   @OA\Property(property="topic", type="string", example="Охота и рыбалка",maximum=100),
 *   @OA\Property(property="title", type="string", example="Охота на медведей",maximum=100),
 *   @OA\Property(property="content", type="string", example="Охота на медведей и все об этом..",maximum=100),
 *   @OA\Property(property="published_at", type="string", example="2024-08-04T14:33:13.000000Z",maximum=100),
 * ),
 */

class PostCreateRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'topic' => [
                'required',
                'string',
                'max:100',
            ],
            'title' => [
                'required',
                'string',
                'max:100',
            ],
            'content' => [
                'required',
                'string',
                'max:100',
            ],
            'published_at' => [
                'required',
                'date',
                'after:now',
            ],
        ];
    }

    public function toServiceParams(): PostCreateServiceParams
    {
        return new PostCreateServiceParams(
            topic: $this->get('topic'),
            title: $this->get('title'),
            content: $this->get('content'),
            publishedAt: $this->date('published_at'),
            authorId: auth()->id(),
        );
    }
}
