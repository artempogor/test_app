<?php

namespace App\Services\Media\Params;

use Illuminate\Http\UploadedFile;

class MediaUploadServiceParams
{
    public function __construct(
        public readonly UploadedFile $file,
        public readonly bool $needOptimize,
        public readonly ?int $optimizationLevel,
    )
    {
    }
}