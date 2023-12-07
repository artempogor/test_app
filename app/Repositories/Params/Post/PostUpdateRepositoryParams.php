<?php

namespace App\Repositories\Params\Post;

use App\Models\Post;
use App\Repositories\UpdateRepositoryParamsInterface;
use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostUpdateRepositoryParams extends BaseRepositoryParams implements UpdateRepositoryParamsInterface
{
    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        validator($this->toArray(), [
            'id' => [
                'required',
                'integer',
                Rule::exists(
                    Post::getStaticTable(),
                    Post::getStaticQualifiedKeyName()
                )->withoutTrashed()
            ],
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
        ]);
    }

    public function toAttrs(): array
    {
        return array_filter($this->toArray());
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }
}
