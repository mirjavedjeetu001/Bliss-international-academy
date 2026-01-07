<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        $user = User::updateOrCreate(
            ['email' => 'admin@blissia.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@blissia.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Ensure super-admin role exists
        $role = Role::firstOrCreate(['name' => 'super-admin']);
        // Assign all permissions to super-admin
        $permissions = Permission::pluck('name')->toArray();
        $role->syncPermissions($permissions);
        $user->assignRole($role);
        $user->syncPermissions($permissions);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@blissia.com');
        $this->command->info('Password: password123');
    }
}