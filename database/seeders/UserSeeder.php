<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create user for role administrator, bendahara, wajib pajak, dan pemungut pajak
        $users = [
            [
                'nik' => '9999999999999999',
                'name' => 'Administrator',
                'email' => 'admin@localhost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'administrator'
            ],
            [
                'nik' => '9999999999999998',
                'name' => 'Bendahara',
                'email' => 'bendahara@localhost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'bendahara'
            ],
            [
                'nik' => '9999999999999997',
                'name' => 'Wajib Pajak',
                'email' => 'wajib_pajak@localhost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'wajib pajak'
            ],
            [
                'nik' => '9999999999999996',
                'name' => 'Pemungut Pajak',
                'email' => 'pemungut_pajak@localhost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'pemungut pajak'
            ],
            [
                'nik' => '9999999999999995',
                'name' => 'Operator Umum',
                'email' => 'operator_umum@localhost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'operator umum'
            ]
        ];

        foreach ($users as $user) {
            $user_created = \App\Models\User::create([
                'nik' => $user['nik'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password']
            ]);

            $user_created->assignRole($user['role']);
        }
    }
}
