<?php

namespace App\Models;

use App\Support\Responses\ResponseItemInterface;
use App\Support\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Media
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $path
 * @property string $disk
 * @property string $file_hash
 * @property string $collection
 * @property int $size
 * @property Carbon $created_at
 */
class Media extends Model implements ResponseItemInterface
{
    use HasFactory;
    use BaseModelTrait;

    protected $table = 'media';

    protected $guarded = [];
}
