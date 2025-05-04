<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Meri\NameApp\Models\User;

// Seeders -> são criadores de dados para popular o banco de dados quando uma aplicação é criada "Como a criação de usuários padrão para o sistema funcionar, por exemplo"
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
