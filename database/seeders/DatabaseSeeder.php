<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert(['title' => 'test'])
        \App\Models\User::factory(10)->create()->each(function($user) {
            $user->posts()->save(\App\Models\Post::factory()->make());
        });
    }
}
