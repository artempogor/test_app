<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\MediaUploadRequest;
use App\Http\Resources\Api\MediaResource;
use App\Http\Resources\SuccessResource;
use App\Services\Media\Exceptions\UploadFileFailureException;
use App\Services\Media\MediaFileUploadService;
use OpenApi\Annotations as OA;

class MediaController extends Controller
{
    public function __construct(
        protected readonly MediaFileUploadService $uploadService
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/media/upload",
     *     tags={"Media"},
     *     summary="Загрузка медиа-файла",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *      required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                   description="Binary content of file",
     *                   property="file",
     *                   type="string",
     *                   format="binary",
     *               ),
     *               required={"file"}
     *           )
     *       )
     *   ),
     *     @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="success",
     *                   example="true",
     *                   type="boolean",
     *               ),
     *               @OA\Property(
     *                   property="data",
     *                   type="object",
     *                   ref="#/components/schemas/MediaResource"
     *               ),
     *           )
     *       ),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     * @throws UploadFileFailureException
     */
    public function upload(MediaUploadRequest $request): SuccessResource
    {
        $result = $this->uploadService->uploadFile($request->toServiceParams());

        return SuccessResource::make(
            MediaResource::make($result->getItem())
        );
    }
}