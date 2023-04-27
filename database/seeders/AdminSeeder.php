<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('qwertyuiop'),
           'email_verified_at' => Carbon::now(),
        ]);
        $user->assignRole(UserRole::ADMIN);
    }
}
