<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super Admin', 'Admin', 'Teacher', 'Student', 'Parent', 'Accountant', 'Librarian', 'Driver'];

        foreach ($roles as $role) {
            Role::create([
                'title'      => $role,
                'slug'       => slugify($role),
                'is_default' => true,
                'status'     => true,
            ]);
        }

    }
}
