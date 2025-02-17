<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('messages')->insert([
                'sender_id' => rand(1, 10),
                'receiver_id' => rand(1, 10),
                'message_content' => fake()->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
