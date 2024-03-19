<?php

namespace App\Http\Requests\Api\Media;

use App\Services\Media\Params\MediaUploadServiceParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 5)
            ],
            'need_optimize' => [
                'required'
            ],
            'optimize_level' => [
                'integer',
                Rule::requiredIf($this->boolean('need_optimize') === true),
            ]
        ];
    }

    public function toServiceParams(): MediaUploadServiceParams
    {
        return new MediaUploadServiceParams(
            file: $this->file('file'),
            needOptimize: $this->boolean('need_optimize'),
            optimizationLevel: $this->get('optimize_level')
        );
    }
}