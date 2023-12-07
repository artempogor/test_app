<?php


namespace App\Support\Repository;


use App\Repositories\UpdateRepositoryParamsInterface;
use App\Support\Entity\BaseRepositoryParams;
use App\Support\Entity\HasStaticModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModelRepository implements ModelRepository
{

    use HasStaticModel;

    public static function newInstance(): static
    {
        /** @phpstan-ignore-next-line */
        return new static();
    }

    public function create(BaseRepositoryParams $params): Model|null
    {
        return $this->newQuery()->create($params->toAttrs());
    }

    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->newModel()->newQuery();
    }

    public function update(UpdateRepositoryParamsInterface $params): Model|null
    {
        $this->newQuery()->where(['id' => $params->getId()])->update($params->toAttrs());
        return $this->byId($params->getId());

    }

    public function byId(int $id): Model|null
    {
        $model = $this->newQuery()->find($id);

        if (!$model instanceof Model) {
            return null;
        }

        return $model;
    }

    public function delete(UpdateRepositoryParamsInterface $params): bool
    {
        return (bool)$this->newQuery()->where(['id' => $params->getId()])->delete();
    }
}
