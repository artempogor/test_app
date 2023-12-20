<?php

namespace App\Services\Post\Params;

use App\Repositories\Params\Post\PostUpdateRepositoryParams;
use Illuminate\Support\Carbon;

class PostUpdateServiceParams
{
    public function __construct(
        public readonly int     $postId,
        public readonly ?string $topic,
        public readonly ?string $title,
        public readonly ?string $content,
        public readonly ?Carbon $publishedAt,
    )
    {
    }

    public function toRepositoryParams(): PostUpdateRepositoryParams
    {
        return new PostUpdateRepositoryParams([
            'id' => $this->postId,
            'topic' => $this->topic,
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->publishedAt,
        ]);
    }
}