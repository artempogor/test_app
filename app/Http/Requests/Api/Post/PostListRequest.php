<?php

namespace App\Http\Requests\Api\Post;

use App\Services\Post\Params\PostListServiceParams;
use App\Support\Enums\PostOrderByFieldsEnum;
use App\Support\Enums\SortEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostListRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'order_by' => [
                'nullable',
                'string',
                Rule::in(SortEnum::cases()),
            ],
            'field' => [
                'nullable',
                'string',
                Rule::in(PostOrderByFieldsEnum::cases()),
            ],
            'begin_date' => [
                'nullable',
                'date'
            ],
            'end_date' => [
                'nullable',
                'date'
            ],
        ];
    }

    public function toServiceParams(): PostListServiceParams
    {
        return new PostListServiceParams(
            sortBy: $this->enum('order_by', SortEnum::class),
            orderByField: $this->enum('field', PostOrderByFieldsEnum::class),
            beginDate: $this->date('begin_date'),
            endDate: $this->date('end_date'),
        );
    }
}
