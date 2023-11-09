<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $user = User::create([
           'name' => 'Ananta',
           'email' => 'ananta@gmail.com',
           'password' => bcrypt('123123123')
        ]);
        $user->assignRole('user');

        $user = User::create([
           'name' => 'Admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('123123123')
        ]);
        $user->assignRole('admin');
    }
}
