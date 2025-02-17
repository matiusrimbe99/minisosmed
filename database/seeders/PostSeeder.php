<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 10),
                'post_content' => fake()->text(),
                'image_url' => 'https://placehold.co/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
