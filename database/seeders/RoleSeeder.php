<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [UserRole::ADMIN, UserRole::USER];
        foreach ($roles as $role){
            if(Role::where('name', $role)->first() === null){
                Role::create(['name' => $role]);
            }
        }
    }
}
