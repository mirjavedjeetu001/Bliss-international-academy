<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@blissia.com')->first();
        if ($user) {
            $role = Role::firstOrCreate(['name' => 'super-admin']);
            $permissions = Permission::pluck('name')->toArray();
            $role->syncPermissions($permissions);
            $user->assignRole($role);
            $user->syncPermissions($permissions);
            $this->command->info('Super admin role and permissions assigned to admin@blissia.com');
        } else {
            $this->command->error('User admin@blissia.com not found!');
        }
    }
}
