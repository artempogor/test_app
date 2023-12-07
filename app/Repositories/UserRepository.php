<?php

namespace App\Repositories;

use App\Models\User;
use App\Support\Repository\BaseModelRepository;

class UserRepository extends BaseModelRepository
{
    protected static string $modelClass = User::class;

}
