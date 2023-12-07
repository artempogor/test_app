<?php

namespace App\Repositories\Params\Post;

use App\Support\Entity\BaseRepositoryParams;
use App\Support\Enums\PostOrderByFieldsEnum;
use App\Support\Enums\SortEnum;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class PostListRepositoryParams extends BaseRepositoryParams
{
    public function validate(): void
    {
        validator($this->toArray(), [
            'order_by' => [
                'nullable',
                'string',
                Rule::in(SortEnum::cases())
            ],
            'field' => [
                'nullable',
                'string',
                Rule::in(PostOrderByFieldsEnum::cases())
            ],
            'begin_date' => [
                'nullable',
                'date'
            ],
            'end_date' => [
                'nullable',
                'date'
            ],
        ]);
    }

    public function orderBy(): ?SortEnum
    {
        return $this->getAttribute('order_by');
    }

    public function orderField(): ?PostOrderByFieldsEnum
    {
        return $this->getAttribute('field');
    }

    public function beginDate(): ?Carbon
    {
        return $this->getAttribute('begin_date');
    }

    public function endDate(): ?Carbon
    {
        return $this->getAttribute('end_date');
    }
}
