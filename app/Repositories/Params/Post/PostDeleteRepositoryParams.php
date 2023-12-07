<?php

namespace App\Repositories\Params\Post;

use App\Models\Post;
use App\Repositories\UpdateRepositoryParamsInterface;
use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostDeleteRepositoryParams extends BaseRepositoryParams implements UpdateRepositoryParamsInterface
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
        ]);
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }
}
