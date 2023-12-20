<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\Support\FakerTrait;
use Tests\Support\SupportTestTrait;
use Tests\TestCase;

class PostTest extends TestCase
{
    use FakerTrait;
    use SupportTestTrait;
    public function test_create(): void
    {
        $this->boot();

        $response = $this->actingAs($this->user())->postJson(route('posts.create'), [
                "topic" => $this->getFaker()->text(1000),
                "title" => $this->getFaker()->text(1000),
                "content" => $this->getFaker()->text(1000),
                "published_at" => now()->addMinute(),
            ]
        );

        $response->assertStatus(422);

        $response = $this->actingAs($this->user())->postJson(route('posts.create'), [
                "topic" => $this->getFaker()->text(99),
                "title" => $this->getFaker()->text(99),
                "content" => $this->getFaker()->text(99),
                "published_at" => now()->addMinute(),
            ]
        );

        $response->assertStatus(201);
    }

    public function test_list(): void
    {
        $response = $this->get('/api/posts');

        $response->assertStatus(200);

    }

    public function test_update(): void
    {
        $postId = Post::all()->whereNull('deleted_at')->first()->getKey();

        $response = $this->actingAs($this->user())->patchJson(route('posts.update', ['postId' => $postId]), [
                "topic" => $this->getFaker()->title(),
                "title" => "Ловля карася на карпа",
            ]
        );

        $response->assertStatus(200);

        $response = $this->actingAs($this->user())->patchJson(route('posts.update', ['postId' => $postId]), [
                "topic" => $this->getFaker()->title(),
                "title" => "Ловля карася на карпа",
            ]
        );
        $response->assertStatus(200);
    }

    public function test_without_auth(): void
    {
        $postId = Post::all()->whereNull('deleted_at')->first()->getKey();

        $create = $this->patchJson(route('posts.update', ['postId' => $postId]), [
                "topic" => "Охота и рыбалк1а",
                "title" => "Ловля карася на карпа",
            ]
        );

        $create->assertStatus(401);

        $update = $this->deleteJson(route('posts.update', ['postId' => $postId]));

        $update->assertStatus(401);

        $delete = $this->postJson(route('posts.create'), [
                "topic" => "Охота и рыбалка",
                "title" => "Ловля карася на карпа",
                "content" => "Ловля карася на карпа.Ловля карася на карпа",
                "published_at" => "2024-08-04T14:33:13.000000Z"
            ]
        );

        $delete->assertStatus(401);
    }

    public function test_delete(): void
    {
        $postId = Post::all()->whereNull('deleted_at')->first()->getKey();

        $response = $this->actingAs($this->user())->deleteJson(route('posts.delete', ['postId' => $postId]));

        $response->assertStatus(200);
    }
}
