<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('comments')->insert([
                'user_id' => rand(1, 10),
                'post_id' => rand(1, 10),
                'comment_content' => fake()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
