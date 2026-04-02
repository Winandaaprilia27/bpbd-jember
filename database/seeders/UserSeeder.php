<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@bpbd.jember.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
        
        // Kepala BPBD
        User::updateOrCreate(
            ['username' => 'kepala'],
            [
                'name' => 'Kepala BPBD',
                'email' => 'kepala@bpbd.jember.go.id',
                'password' => Hash::make('kepala123'),
                'role' => 'kepala',
                'is_active' => true,
            ]
        );
        
        // Staff
        User::updateOrCreate(
            ['username' => 'staff'],
            [
                'name' => 'Staff Kepegawaian',
                'email' => 'staff@bpbd.jember.go.id',
                'password' => Hash::make('staff123'),
                'role' => 'staff',
                'is_active' => true,
            ]
        );
        
        $this->command->info('✅ Users seeded successfully!');
        $this->command->info('Username: admin, kepala, staff');
        $this->command->info('Password: admin123, kepala123, staff123');
    }
}