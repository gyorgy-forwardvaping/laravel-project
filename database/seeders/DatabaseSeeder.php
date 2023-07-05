<?php

namespace Database\Seeders;

// use App\Models\Post;
// use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // User::factory(10)->has(
        //     Post::factory()->count(2)
        // )->create();
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->posts()->save(\App\Models\Post::factory()->make());
            // die();
            // $user->posts()->save(\App\Models\Post::factory(1)->make());
            // \App\Models\Post::factory(2)->create(['user_id' => $user->id]);
        });

        // \App\Models\User::factory()->has(\App\Models\Post::factory()->count(2))->create();
    }
}
