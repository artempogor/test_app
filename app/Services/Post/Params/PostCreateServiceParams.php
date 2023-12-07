<?php

namespace App\Services\Post\Params;

use App\Repositories\Params\Post\PostCreateRepositoryParams;
use Illuminate\Support\Carbon;

class PostCreateServiceParams
{
    public function __construct(
        public readonly string $topic,
        public readonly string $title,
        public readonly string $content,
        public readonly Carbon $publishedAt,
        public readonly int    $authorId
    )
    {
    }

    public function toRepositoryParams(): PostCreateRepositoryParams
    {
        return new PostCreateRepositoryParams([
            'topic' => $this->topic,
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->publishedAt,
            'author_id' => $this->authorId,
        ]);
    }
}