<?php

namespace App\Services\Media;

use App\Models\Media;
use App\Repositories\MediaRepository;
use App\Repositories\Params\Media\MediaUploadRepositoryParams;
use App\Services\Media\Exceptions\UploadFileFailureException;
use App\Services\Media\Params\MediaUploadServiceParams;
use App\Support\Responses\BaseItemResponse;
use Illuminate\Support\Facades\Storage;

class MediaFileUploadService
{
    private const PATH = '/public/media/';

    public function __construct(
        private readonly MediaRepository $mediaRepository
    )
    {
    }

    /**
     * @throws UploadFileFailureException
     */
    public function uploadFile(MediaUploadServiceParams $params): BaseItemResponse
    {
        try {
            return $this->putAndCreate($params);
        } catch (\Throwable $exception) {
            throw new UploadFileFailureException();
        }
    }

    private function putAndCreate(MediaUploadServiceParams $params): BaseItemResponse
    {

        $name = $params->file->hashName();

        $mimeType = $params->file->getMimeType();

        $path = $this->pathFromType($mimeType);

        Storage::disk(config('media.disk'))->put($path, $params->file);

        $repositoryParams = new MediaUploadRepositoryParams([
            'name' => $name,
            'mime_type' => $mimeType,
            'file_name' => $params->file->getClientOriginalName(),
            'path' => $path . $name,
            'disk' => config('media.disk'),
            'file_hash' => hash_file(config('media.hash_algo'), Storage::path($path . $name)),
            'collection' => null,
            'size' => $params->file->getSize(),
        ]);
        /** @var Media $item */
        $item = $this->mediaRepository->create($repositoryParams);

        return new BaseItemResponse($item);
    }

    private function pathFromType(string $type): string
    {
        $path = match ($type) {
            'image' => 'images',
            'video' => 'videos',
            'document' => 'documents',
            default => 'others',
        };

        return $path . self::PATH;
    }
}