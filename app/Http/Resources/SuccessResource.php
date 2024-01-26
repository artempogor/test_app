<?php


namespace App\Http\Resources;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SuccessResource",
 *     description="Success resource",
 *     required={"success", "data"},
 *     type="object",
 *     @OA\Property(
 *         property="success",
 *         type="boolean",
 *         description="Success status",
 *         example="true"
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         description="Data",
 *         example="true"
 *     ),
 )
 )
 * )
 */
class SuccessResource extends JsonResource
{

    public static function empty(): SuccessResource
    {
        return self::make([]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'success' => true,
            'data' => $this->resource instanceof Arrayable ? $this->resource->toArray() : $this->resource
        ];
    }
}
