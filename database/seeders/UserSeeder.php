<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', '=', env('ADMIN_EMAIL'))->first();
        if ($user === null) {
            // user doesn't exist
            User::firstOrCreate([
                'name' => 'Admin',
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD'))
            ]);
        }
    }
}
