<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@homework.com',
            'email_verified_at' => now(),
            'password' => Hash::make('SecurePassword123!'),
            'is_admin' => 1,
            'remember_token' => Str::random(10),
        ]);
        
        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@homework.com');
        $this->command->info('Password: SecurePassword123!');
    }
}