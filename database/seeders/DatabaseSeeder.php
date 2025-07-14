<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Position;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk role dan posisi
        $this->call([
            RoleSeeder::class,
            PositionSeeder::class,
        ]);

      
        $users = [
            [
                'name' => 'Atha Operator',
                'email' => 'operator@atha.com',
                'role' => 'operator',
                'position' => 'Operator',
            ],
            [
                'name' => 'Atha Manager',
                'email' => 'manager@atha.com',
                'role' => 'admin', // jika kamu pakai role 'manager' buat juga seedernya
                'position' => 'Manager',
            ],
            [
                'name' => 'Atha Direktur',
                'email' => 'direktur@atha.com',
                'role' => 'admin', // jika direktur punya role sendiri, ubah ini
                'position' => 'Direktur',
            ],
            [
                'name' => 'Atha Pegawai',
                'email' => 'pegawai@atha.com',
                'role' => 'user',
                'position' => 'Pegawai',
            ],
        ];

        foreach ($users as $u) {
            if (!User::where('email', $u['email'])->exists()) {
                User::create([
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'), // default password
                    'phone' => fake()->phoneNumber(),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::where('name', $u['role'])->value('id'),
                    'position_id' => Position::where('name', $u['position'])->value('id'),
                ]);
            }
        }
    }
}
