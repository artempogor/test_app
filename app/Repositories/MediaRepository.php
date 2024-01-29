<?php

namespace App\Repositories;

use App\Models\Media;
use App\Support\Repository\BaseModelRepository;

class MediaRepository extends BaseModelRepository
{
    protected static string $modelClass = Media::class;

}
