<?php

namespace App\Services\Media\Exceptions;

use Exception;

class UploadFileFailureException extends Exception
{
    public function __construct()
    {
        parent::__construct('Ошибка загрузки файла', 500);
    }
}