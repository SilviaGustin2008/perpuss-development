<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'admin',
            'alamat' => 'xxx',
            'telepon' => '12345',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin@123'),
            'jenis' => 'admin',
        ]);
    }
}