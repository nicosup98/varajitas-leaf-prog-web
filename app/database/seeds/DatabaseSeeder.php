<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Database\Seeds\VarajasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed your application's database.
     * @return void
     */
    public function run(): array
    {
        return [
            UsersSeeder::class,
            VarajasSeeder::class
        ];
    }
}
