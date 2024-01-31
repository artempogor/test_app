<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Support\FakerTrait;
use Tests\Support\SupportTestTrait;
use Tests\TestCase;

class MediaUploadTest extends TestCase
{
    use FakerTrait;
    use SupportTestTrait;

    public function test_upload(): void
    {
        $this->boot();

        Storage::fake('testUpload');

        $response = $this->actingAs($this->user())->json('POST', '/api/media/upload', [
            'file' => UploadedFile::fake()->image('test.jpg'),
        ]);

        $response->assertStatus(200);

        $response = $this->actingAs($this->user())->json('POST', '/api/media/upload', [
            'file' => UploadedFile::fake()->image('test.jpg')->size(1024 * 6) ,
        ]);

        $response->assertStatus(422);

        $response = $this->actingAs($this->user())->json('POST', '/api/media/upload', [
            'file' => UploadedFile::fake()->create('test.pdf')->size(1024 * 5) ,
        ]);

        $response->assertStatus(422);
    }

    public function test_exists(): void
    {
        $this->actingAs($this->user())->json('POST', '/api/media/upload', [
            'file' => UploadedFile::fake()->create('test.test',1024 * 10,'test/test'),
        ]);

        Storage::disk('local')->assertExists('test.jpg');

        Storage::disk('local')->assertMissing('test.jpg');

        Storage::disk('local')->assertDirectoryEmpty('/wallpapers');

    }

}
