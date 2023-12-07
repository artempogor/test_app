<?php

namespace App\Services\Post\Responses;


use App\Models\Post;

class PostResponse
{
    private Post $post;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Contract
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}