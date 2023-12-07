<?php

namespace App\Services\Post\Params;

use App\Repositories\Params\Post\PostListRepositoryParams;
use App\Support\Enums\PostOrderByFieldsEnum;
use App\Support\Enums\SortEnum;
use Carbon\Carbon;

class PostListServiceParams
{
    public function __construct(
        public readonly ?SortEnum              $sortBy,
        public readonly ?PostOrderByFieldsEnum $orderByField,
        public readonly ?Carbon                $beginDate,
        public readonly ?Carbon                $endDate,
    )
    {
    }

    public function toRepositoryParams(): PostListRepositoryParams
    {
        return new PostListRepositoryParams([
            'order_by' => $this->sortBy,
            'field' => $this->orderByField,
            'begin_date' => $this->beginDate,
            'end_date' => $this->endDate
        ]);
    }
}