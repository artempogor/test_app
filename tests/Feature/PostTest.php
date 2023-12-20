<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Tests\Support\FakerTrait;
use Tests\TestCase;

class PostTest extends TestCase
{
    use FakerTrait;

    public function test_list(): void
    {
        Artisan::call('migrate');

        $response = $this->get('/api/posts');

        $response->assertStatus(200);

    }

    public function test_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('posts.create'), [
                "topic" => $this->getFaker()->text(1000),
                "title" => $this->getFaker()->text(1000),
                "content" => $this->getFaker()->text(1000),
                "published_at" => now()->addMinute(),
            ]
        );
        $response->assertStatus(422);

        $response = $this->actingAs($user)->postJson(route('posts.create'), [
                "topic" => $this->getFaker()->text(99),
                "title" => $this->getFaker()->text(99),
                "content" => $this->getFaker()->text(99),
                "published_at" => now()->addMinute(),
            ]
        );

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();

        $postId = Post::all()->whereNull('deleted_at')->last()->getKey();

        $response = $this->actingAs($user)->patchJson(route('posts.update', ['postId' => $postId]), [
                "topic" => $this->getFaker()->title(),
                "title" => "Ловля карася на карпа",
            ]
        );

        $response->assertStatus(200);

        $response = $this->actingAs($user)->patchJson(route('posts.update', ['postId' => $postId]), [
                "topic" => $this->getFaker()->title(),
                "title" => "Ловля карася на карпа",
            ]
        );
        $response->assertStatus(200);
    }

    public function test_delete(): void
    {
        $user = User::factory()->create();

        $postId = Post::all()->whereNull('deleted_at')->last()->getKey();

        $response = $this->actingAs($user)->deleteJson(route('posts.delete', ['postId' => $postId]));

        $response->assertStatus(200);
    }

    public function test_without_auth(): void
    {
        $postId = Post::all()->whereNull('deleted_at')->last()->getKey();

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
}
