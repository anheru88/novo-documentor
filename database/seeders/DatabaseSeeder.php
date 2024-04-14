<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        ]);

        User::factory()->create([
            'name' => 'Angel Jimenez Escobar',
            'email' => 'ajimenezescobar@gmail.com',
            'password' => '$2y$12$Zv0C888tGSo.zjt6Vd9EOOEFLevRCSNt0vAA0HF5KfPkn9/9qZQK.',
            'remember_token' => 'GnjrRSzUqm',
        ]);
    }
}
