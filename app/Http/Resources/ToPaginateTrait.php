<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\V1\SuccessResource;
use App\Http\Resources\Support\CursorPaginationResource;
use App\Http\Resources\Support\PaginationResource;
use App\Modules\Main\Entity\CursorPaginationEntity;
use App\Modules\Main\Entity\PaginationEntity;
use Illuminate\Http\Resources\MissingValue;

/**
 * Расширение ресурса для вывода постраничной коллекции
 *
 * Пример получения обычной коллекции ресурсов:
 * NotificationResource::collection($items)
 *
 * Пример получения постраничной коллекции ресурсов
 * NotificationResource::toPaginate($items, $paginateEntity)
 */
trait ToPaginateTrait
{
    public static function withoutPaginate($items): SuccessResource
    {
        return new SuccessResource(self::collection($items));
    }

    public static function toPaginate($items, ?PaginationEntity $paginationEntity = null): SuccessResource
    {
        return new SuccessResource([
            'items' => self::collection($items),
            'pagination' => $paginationEntity
                ? PaginationResource::make($paginationEntity)
                : new MissingValue(),
        ]);
    }

    public static function toCursorPaginate($items, ?CursorPaginationEntity $paginationEntity = null): SuccessResource
    {
        return new SuccessResource([
            'items' => self::collection($items),
            'pagination' => $paginationEntity
                ? CursorPaginationResource::make($paginationEntity)
                : new MissingValue(),
        ]);
    }
}
