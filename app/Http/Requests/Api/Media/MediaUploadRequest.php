<?php

namespace App\Http\Requests\Api\Media;

use App\Services\Media\Params\MediaUploadServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class MediaUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 1024 * 5)
            ],
        ];
    }

    public function toServiceParams(): MediaUploadServiceParams
    {
        return new MediaUploadServiceParams(
            file: $this->file('file'),
        );
    }
}