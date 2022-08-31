<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'UserName',
            'email' => 'User@mailaddress.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
        ]);
        
        User::create([
            'name' => '山田太郎',
            'email' => 'yamada@mailaddress.com',
            'password' => bcrypt('m243inge'),
            'email_verified_at' => now(),
            'created_at' => now(),
        ]);
        
        User::create([
            'name' => '高木花子',
            'email' => 'hanako@mailaddress.com',
            'password' => bcrypt('r6wyjhz2'),
            'email_verified_at' => now(),
            'created_at' => now(),
        ]);
    }
}
