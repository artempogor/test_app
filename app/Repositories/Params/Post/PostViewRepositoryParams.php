<?php

namespace App\Repositories\Params\Post;

use App\Models\Post;
use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostViewRepositoryParams extends BaseRepositoryParams
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
