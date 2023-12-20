<?php

namespace Tests\Support;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

trait SupportTestTrait
{
    public function boot(): void
    {
        if (!DB::table('users')->exists()) {
            Artisan::call('migrate');
        }

        if (User::all()->isEmpty()) {
            User::factory()->create();
        }
    }

    public function user(): User
    {
        return User::all()->first();
    }
}