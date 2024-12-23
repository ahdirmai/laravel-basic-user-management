<?php

namespace Database\Seeders;

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
        // administrator, bendahara, wajib pajak, dan pemungut pajak
        $roles = [
            'administrator',
            'bendahara',
            'wajib pajak',
            'pemungut pajak',
            'operator umum'
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
