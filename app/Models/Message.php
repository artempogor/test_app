<?php

namespace App\Models;

use App\Support\Traits\BaseModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Message
 * @package App\Models\Message
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 */
class Message extends Model
{
    use HasFactory;
    use BaseModelTrait;

    protected $table = 'messages';
    protected $fillable = [
        'message',
        'user_id_author',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_author');
    }
}
