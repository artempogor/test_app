<?php

namespace App\Models;

use App\Support\Traits\BaseModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $topic
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property Carbon|null $published_at
 * @property User $user
 */
class Post extends Model
{
    use HasFactory;
    use BaseModelTrait;
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'topic',
        'title',
        'content',
        'author_id',
        'published_at'
    ];
    protected $dates = [
        'published_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
