<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Status;

use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Francisco Ayapantecalth 	jfcruz@outlook.com 	super admin 	
        Jesus Armando Castro Tun 	jesus.castro@meracorporation.com 	super admin 	
        
        */
        // Crear roles
        $SuperAdminRole = Role::firstWhere('name', 'super admin');

        // Obtenemos el estado activo
        $statusActive = Status::firstWhere('name', 'Activo');

        // Crear usuario Super Admin Francisco
        $AdminFrank = User::firstOrCreate(
            ['email' => 'jfcruz@outlook.com'],
            [
                'name' => 'Francisco',
                'last_name' => 'Ayapantecalth',
                'password' => Hash::make('P4$$wOrd-2025SA'),
                'status_id' => $statusActive->id,
            ]
        );

        // crear usuario Super Admin Jesus Armando Castro Tun
        $AdminJesus = User::firstOrCreate(
            ['email' => 'jesus.castro@meracorporation.com'],
            [
                'name' => 'Jesús Armando',
                'last_name' => 'Castro Tun',
                'password' => Hash::make('P4$$wOrd-2025SA'),
                'status_id' => $statusActive->id,
            ]
        );

        // Asignar rol de super admin a los usuarios creados
        $AdminFrank->assignRole($SuperAdminRole);
        $AdminJesus->assignRole($SuperAdminRole);
    }
}
