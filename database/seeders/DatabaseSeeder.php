<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@preorder.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'tenant_id' => null,
            'is_active' => true,
        ]);
    }
}
