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
        User::truncate();
        $data = [
            'name' => 'Hoàng Văn Hùng',
            'email' => 'hungkio16.9.98@gmail.com',
            'password' => Hash::make('admin'),
            'role' => User::ADMIN
        ];
        User::create($data);
    }
}
