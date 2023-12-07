<?php

namespace App\Http\Requests\Api\Post;

use App\Models\Post;
use App\Services\Post\Params\PostDeleteServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostDeleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
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

    public function toServiceParams(): PostDeleteServiceParams
    {
        return new PostDeleteServiceParams(
            postId: (int)$this->route('postId'),
        );
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['post_id' => (int)$this->route('postId')]);
    }
}
