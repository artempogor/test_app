<?php

namespace App\Repositories\Params\Media;

use App\Support\Entity\BaseRepositoryParams;
use Illuminate\Validation\Rules\File;

class MediaUploadRepositoryParams extends BaseRepositoryParams
{
    public function validate(): void
    {
        validator($this->toArray(), [
            'file' => [
                'required',
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 1024 * 5)
            ],
        ]);
    }
}
