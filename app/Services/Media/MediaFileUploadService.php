<?php

namespace App\Services\Media;

use App\Models\Media;
use App\Repositories\MediaRepository;
use App\Repositories\Params\Media\MediaUploadRepositoryParams;
use App\Services\Media\Exceptions\UploadFileFailureException;
use App\Services\Media\Params\MediaUploadServiceParams;
use App\Support\Responses\BaseItemResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class MediaFileUploadService
{
    private const PATH = '/media/';

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

    /**
     * @param MediaUploadServiceParams $params
     * @return BaseItemResponse
     */
    private function putAndCreate(MediaUploadServiceParams $params): BaseItemResponse
    {
        $name = $params->file->hashName();

        $mimeType = $params->file->getMimeType();

        $path = $this->pathFromType($mimeType);

        if ($params->needOptimize) {
            $this->optimizeImage($path, $params->file, $params->optimizationLevel);
        } else {
            Storage::put($path, $params->file);
        }

        $repositoryParams = new MediaUploadRepositoryParams([
            'name' => $name,
            'mime_type' => $mimeType,
            'file_name' => $params->file->getClientOriginalName(),
            'path' => $path . $name,
            'disk' => config('filesystems.default'),
            'file_hash' => '1',
            'collection' => null,
            'size' => Storage::size($path . $name),
        ]);
        /** @var Media $item */
        $item = $this->mediaRepository->create($repositoryParams);

        return new BaseItemResponse($item);
    }

    /**
     * @param string $type
     * @return string
     */
    private function pathFromType(string $type): string
    {
        $path = match ($type) {
            'image/jpeg', 'image/png' => 'images',
            'video' => 'videos',
            'document' => 'documents',
            default => 'others',
        };

        if (($type === 'test') && config('app.env') === 'local') {
            $path = 'testing';
        }

        $path .= '/';

        return self::PATH . $path;
    }

    /**
     * @param string $path
     * @param UploadedFile $file
     * @param int|null $optimizationLevel
     * @return void
     */
    private function optimizeImage(string $path, UploadedFile $file, int $optimizationLevel = null): void
    {
        $path .= '/' . $file->hashName();

        $optimizedImagePath = Http::imageOptimize()
            ->attach('image', file_get_contents($file), $file->getClientOriginalName())
            ->post('api/optimize', ['optimize_level' => $optimizationLevel]);

        $optimizedFile = file_get_contents('http://host.docker.internal:8876/' . $optimizedImagePath['path']);

        Storage::put($path, $optimizedFile);
    }
}