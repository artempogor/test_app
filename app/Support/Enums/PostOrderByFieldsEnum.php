<?php

namespace App\Support\Enums;

enum PostOrderByFieldsEnum: string
{
    case CREATED_AT = 'created_at';

    case UPDATED_AT = 'updated_at';

    case PUBLISHED_AT = 'published_at';

}
