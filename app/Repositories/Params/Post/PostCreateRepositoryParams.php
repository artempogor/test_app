<?php

namespace App\Repositories\Params\Post;

use App\Models\User;
use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostCreateRepositoryParams extends BaseRepositoryParams
{
    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        validator($this->toArray(), [
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
            'author_id' => [
                'integer',
                'required',
                Rule::exists(
                    User::getStaticTable(),
                    User::getStaticQualifiedKeyName()
                ),
            ],
        ]);
    }
}
