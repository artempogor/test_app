<?php

namespace App\Http\Requests\Api\Post;

use App\Models\Post;
use App\Services\Post\Params\PostUpdateServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="PostUpdateRequest",
 *      description="Post create request body",
 *      type="object",
 *   @OA\Property(property="topic", type="string", example="Охота и рыбалка",maximum=100),
 *   @OA\Property(property="title", type="string", example="Охота на медведей",maximum=100),
 *   @OA\Property(property="content", type="string", example="Охота на медведей и все об этом..",maximum=100),
 *   @OA\Property(property="published_at", type="string", example="2024-08-04T14:33:13.000000Z",maximum=100),
 * ),
 */
class PostUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'topic' => [
                'nullable',
                'string',
                'max:100',
            ],
            'title' => [
                'nullable',
                'string',
                'max:100',
            ],
            'content' => [
                'nullable',
                'string',
                'max:100',
            ],
            'published_at' => [
                'nullable',
                'date',
                'after:now',
            ],
            'post_id' => [
                'required',
                'integer',
                Rule::exists(
                    Post::getStaticTable(),
                    Post::getStaticQualifiedKeyName()
                )->withoutTrashed()
            ],
        ];
    }

    public function toServiceParams(): PostUpdateServiceParams
    {
        return new PostUpdateServiceParams(
            postId: (int)$this->route('postId'),
            topic: $this->get('topic'),
            title: $this->get('title'),
            content: $this->get('content'),
            publishedAt: $this->date('published_at'),
        );
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['post_id' => (int)$this->route('postId')]);
    }
}
