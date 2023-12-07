<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Params\Post\PostListRepositoryParams;
use App\Support\Enums\PostOrderByFieldsEnum;
use App\Support\Enums\SortEnum;
use App\Support\Repository\BaseModelRepository;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseModelRepository
{
    protected static string $modelClass = Post::class;

    public function list(PostListRepositoryParams $params):Collection|array
    {
        $orderBy = $params->orderBy()->value ?? SortEnum::ASC->value;
        $field = $params->orderField()->value ?? PostOrderByFieldsEnum::PUBLISHED_AT->value;

        $query = $this->newQuery();

        if ($params->beginDate()) {
            $query->whereDate($field, '>=', $params->beginDate());
        }

        if ($params->endDate()) {
            $query->whereDate($field, '<=', $params->endDate());
        }

        return $query
            ->orderBy($field, $orderBy)
            ->get();
    }
}
