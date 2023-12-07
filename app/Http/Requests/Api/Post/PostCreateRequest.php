<?php

namespace App\Http\Requests\Api\Post;

use App\Services\Post\Params\PostCreateServiceParams;
use Illuminate\Foundation\Http\FormRequest;

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
