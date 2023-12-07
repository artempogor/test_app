<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('topic', 100)
                ->comment('Тема');
            //справочник тем нужно вынести в отдельную таблицы, и связывать ключём
            $table->string('title', 256)
                ->comment('Заголовок поста');
            $table->string('content', 1000)
                ->comment('Пост');
            $table->foreignId('author_id')
                ->comment('Автор поста');
            $table->foreign('author_id')
                ->on('users')
                ->references('id');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['topic', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
