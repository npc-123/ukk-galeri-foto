<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'cyvas',
            'email' => 'test@example.com',
            'password' => bcrypt('m'),
            'NamaLengkap' => 'Nasrul Aziz',
            'Alamat' => 'kepuh',
            'Foto' => 'default.png'
        ]);
        \App\Models\User::factory()->create([
            'username' => 'a',
            'email' => 'tests@example.com',
            'password' => bcrypt('m'),
            'NamaLengkap' => 'Nasrul Aziz',
            'Alamat' => 'kepuh',
            'Foto' => 'default.png'
        ]);
    }
}
