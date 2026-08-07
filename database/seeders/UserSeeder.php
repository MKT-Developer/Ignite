<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Status;

use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        $statusActive = Status::firstWhere('name', 'Activo');

        $superAdminRole = Role::firstWhere('name', 'super admin');
        $adminRole = Role::firstWhere('name', 'admin');
        $userRole = Role::firstWhere('name', 'user');


        // $password = Hash::make(
        //     'MeraIgnite2026_'
        // );


        $generateEmployeeNumber = function () {

            do {

                $number = random_int(100000, 999999);
            } while (
                User::where(
                    'employee_number',
                    $number
                )->exists()
            );


            return $number;
        };


        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmins = [
            [
                'employee_number' => '000000',
                'name' => 'Francisco',
                'last_name' => 'Ayapantecalth',
                'email' => 'jfcruz@outlook.com',
                'country' => 'México',
                'role' => 'super admin',
            ],

            [
                'employee_number' => '10002',
                'name' => 'Jesús Armando',
                'last_name' => 'Castro Tun',
                'email' => 'jesus.castro@meracorporation.com',
                'country' => 'México',
                'role' => 'super admin',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Administradores
        |--------------------------------------------------------------------------
        */

        $admins = [

            [
                'employee_number' => '10876',
                'name' => 'Leslie Montserrat',
                'last_name' => 'Marquez Rios',
                'email' => 'leslie.marquez@meracorporation.com',
                'country' => 'México',
                'role' => 'admin',
            ],

            [
                'employee_number' => '10071',
                'name' => 'Pamela',
                'last_name' => 'Perez Reyes',
                'email' => 'pamelap@meracorporation.com',
                'country' => 'México',
                'role' => 'admin',
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | Usuarios generales
        |--------------------------------------------------------------------------
        */
        $users = [

            [
                'employee_number' => '10285',
                'name' => 'Alejandro',
                'last_name' => 'Fuentes Ramirez',
                'email' => 'alejandrof@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '8',
                'name' => 'Alejandro Jose',
                'last_name' => 'Casares Espinosa',
                'email' => 'alejandroc@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '8004',
                'name' => 'Andrea Carolina',
                'last_name' => 'Martinez Espitia',
                'email' => 'andrea.martinez@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10607',
                'name' => 'Angel Eduardo',
                'last_name' => 'May Garcia',
                'email' => 'angelm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '13116',
                'name' => 'Angelita Enriqueta',
                'last_name' => 'Proaño Rojas',
                'email' => 'angelitap@meramexair.com',
                'country' => 'LATAM',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Armando',
                'last_name' => 'Colomer',
                'email' => 'armandoc@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '193',
                'name' => 'Axel',
                'last_name' => 'Molet Warschawski',
                'email' => 'axelm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10748',
                'name' => 'Betsabe Guadalupe',
                'last_name' => 'Llorente Hernandez',
                'email' => 'gteadminmzt@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10548',
                'name' => 'Blanca Guadalupe',
                'last_name' => 'Chavez Ceniceros',
                'email' => 'gteadmindgo@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '9907',
                'name' => 'Blanca Veronica',
                'last_name' => 'Velarde Terrones',
                'email' => 'blancav@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '292',
                'name' => 'Carlos Alberto',
                'last_name' => 'Ibarra Ruiz',
                'email' => 'carlosi@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '56',
                'name' => 'Carlos Enrique',
                'last_name' => 'Escalante Rivera',
                'email' => 'carlose@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '13178',
                'name' => 'Christian Ramses',
                'last_name' => 'Aguayo Padilla',
                'email' => 'ramses.aguayo@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '8191',
                'name' => 'Cindy Nallely',
                'last_name' => 'Gallardo Soni',
                'email' => 'gteadminmty@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '13216',
                'name' => 'Claritza Del Carmen',
                'last_name' => 'Fajardo Cordero',
                'email' => 'gteadminpty@meracorporation.com',
                'country' => 'Panamá',
                'role' => 'user',
            ],

            [
                'employee_number' => '87',
                'name' => 'Claudia',
                'last_name' => 'Vasquez Robles',
                'email' => 'claudiav@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '413',
                'name' => 'Cora Citlali',
                'last_name' => 'Roque Tilit',
                'email' => 'citlalir@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '3659',
                'name' => 'Corintiam',
                'last_name' => 'Andrade Angulo',
                'email' => 'gteadminoax@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Cristian Nallely',
                'last_name' => 'Colin Malvais',
                'email' => 'cristian.colin@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '22',
                'name' => 'Cruz Waldemar',
                'last_name' => 'Poot Euan',
                'email' => 'waldemarp@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '363',
                'name' => 'Daniel',
                'last_name' => 'Olmeda Garcia',
                'email' => 'danielog@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '34',
                'name' => 'Darinel',
                'last_name' => 'Morales Alamiya',
                'email' => 'darinelm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '31',
                'name' => 'David',
                'last_name' => 'Tapia Torres Leal',
                'email' => 'davidinbox@outlook.com',
                'country' => 'Panamá',
                'role' => 'user',
            ],

            [
                'employee_number' => '16',
                'name' => 'Edgar',
                'last_name' => 'Alvarez Romero',
                'email' => 'edgara@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10569',
                'name' => 'Edna Berenice',
                'last_name' => 'Aguilar Sanchez',
                'email' => 'gteadmingdl@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '13287',
                'name' => 'Elizabet',
                'last_name' => 'Martinez',
                'email' => 'elizabetm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '4342',
                'name' => 'Elizabeth',
                'last_name' => 'Sanchez Camargo',
                'email' => 'elizabeths@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Elsy Janeth',
                'last_name' => 'Garzón Aguilar',
                'email' => 'janethg@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '746',
                'name' => 'Emanuel',
                'last_name' => 'Vazquez Diaz',
                'email' => 'emanuelv@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '137',
                'name' => 'Emanuel Jesus',
                'last_name' => 'Tun Quijano',
                'email' => 'emanuelt@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '24',
                'name' => 'Fabricio',
                'last_name' => 'Garcia',
                'email' => 'fabriciog@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '412',
                'name' => 'Felipe Ivan',
                'last_name' => 'Orozco Castillo',
                'email' => 'felipeo@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '5463',
                'name' => 'Fernando',
                'last_name' => 'Gomez',
                'email' => 'supoperaczm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '6',
                'name' => 'Frederic Maurice Georges',
                'last_name' => 'Touzeau',
                'email' => 'frederict@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '3',
                'name' => 'Gabriel Ernesto',
                'last_name' => 'Marquez De La Torre',
                'email' => 'gabrielm@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Garrett',
                'last_name' => 'Devereux',
                'email' => 'garrett.devereux@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '1',
                'name' => 'Gustavo',
                'last_name' => 'Hernandez De Aguirre',
                'email' => 'gustavoh@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '160',
                'name' => 'Gustavo',
                'last_name' => 'Marquez Lartigue',
                'email' => 'gustavom@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '165',
                'name' => 'Gustavo Eduardo',
                'last_name' => 'Hernandez Rodriguez',
                'email' => 'eduardoh@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '2943',
                'name' => 'Itzia Geovanna',
                'last_name' => 'Suarez Vadillo',
                'email' => 'gteadmintij@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Jasmine',
                'last_name' => 'Edwards',
                'email' => 'jedwards@southriverlaw.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '374',
                'name' => 'Jessica',
                'last_name' => 'Garibay Amandi',
                'email' => 'jessicag@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '303',
                'name' => 'Joaquin',
                'last_name' => 'Rojas Lopez',
                'email' => 'joaquinr@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '12434',
                'name' => 'Jorge Carlos',
                'last_name' => 'Ramirez',
                'email' => 'carlosl@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '30',
                'name' => 'Jorge Facundo',
                'last_name' => 'Sanchez Lugo',
                'email' => 'facundos@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '240',
                'name' => 'Jorge Roberto',
                'last_name' => 'Fernandez Ovalle',
                'email' => 'jorgef@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '12677',
                'name' => 'Jose Carlos',
                'last_name' => 'Caamal',
                'email' => 'josec@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '58',
                'name' => 'Jose Damian',
                'last_name' => 'Xuluc May',
                'email' => 'damianx@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '12675',
                'name' => 'Jose Roman',
                'last_name' => 'Bautista Santiago',
                'email' => 'gteadmintam@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '227',
                'name' => 'Juan Pablo',
                'last_name' => 'Aguirre De La Torre',
                'email' => 'juanpabloat@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '123',
                'name' => 'Juan Ricardo',
                'last_name' => 'Arevalo Alvarez',
                'email' => 'ricardoa@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '530',
                'name' => 'Karen Odeth',
                'last_name' => 'Flores Avila',
                'email' => 'karenf@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '9',
                'name' => 'Karla',
                'last_name' => 'Velazquez Torres',
                'email' => 'karlav@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '275',
                'name' => 'Karla Alejandrina',
                'last_name' => 'Cruz Gomez',
                'email' => 'karlac@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Katherine',
                'last_name' => 'Arbelaez',
                'email' => 'gteadminmde@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '11882',
                'name' => 'Katherine Carolina',
                'last_name' => 'Flores Reyes',
                'email' => 'gteadminpvr@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10876',
                'name' => 'Leslie Montserrat',
                'last_name' => 'Marquez Rios',
                'email' => 'leslie.marquez@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '3080',
                'name' => 'Liborio Agustin',
                'last_name' => 'Longoria Casas',
                'email' => 'liboriol@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '200',
                'name' => 'Lilia Edwina',
                'last_name' => 'Hidalgo Flores',
                'email' => 'lilyh@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '9316',
                'name' => 'Linda',
                'last_name' => 'Roman',
                'email' => 'lindar@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Loreny',
                'last_name' => 'Silva',
                'email' => 'rhcolombia@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '105',
                'name' => 'Luis Alberto',
                'last_name' => 'Vila Islas',
                'email' => 'luisv@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '385',
                'name' => 'Luisa',
                'last_name' => 'Reyes Marquez',
                'email' => 'luisar@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '13410',
                'name' => 'Manuel Adrián /(2) EDU',
                'last_name' => 'Dzib',
                'email' => 'adrian.dzib@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '2',
                'name' => 'Manuel Gerardo',
                'last_name' => 'Gonzalez Garza',
                'email' => 'manuelg@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Marcela',
                'last_name' => 'Flores Maura',
                'email' => 'marcelaf@meramexair.com',
                'country' => 'Ecuador',
                'role' => 'user',
            ],

            [
                'employee_number' => '39',
                'name' => 'Marco Antonio',
                'last_name' => 'Vega Alvarez',
                'email' => 'marcov@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Mareco',
                'last_name' => 'Edwards',
                'email' => 'medwards@southriverlaw.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '12333',
                'name' => 'Maria Del Pilar',
                'last_name' => 'Nava Quiñonez',
                'email' => 'gteadmincjs@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '91',
                'name' => 'Mariana',
                'last_name' => 'Chavez Gomez',
                'email' => 'marianac@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '903',
                'name' => 'Mariandrea II MERA U (2)',
                'last_name' => 'Aguirre De La Torre',
                'email' => 'maguirre@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '263',
                'name' => 'Mario',
                'last_name' => 'Hernandez Palma',
                'email' => 'marioh@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '98',
                'name' => 'Marisol',
                'last_name' => 'Castro Dzul',
                'email' => 'marisolc@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '100',
                'name' => 'Mercedes',
                'last_name' => 'Aguirre De La Torre',
                'email' => 'mercedesaguirre@me.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Michael',
                'last_name' => 'Taylor',
                'email' => 'michael.taylor@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => '8729',
                'name' => 'Midori Yessica',
                'last_name' => 'Hayakawa Hernandez',
                'email' => 'midorih@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '136',
                'name' => 'Miguel Angel',
                'last_name' => 'Ortiz Leon',
                'email' => 'miguelo@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Miguel Ángel',
                'last_name' => 'Reyes Sosa',
                'email' => 'miguelr@meracorporation.com',
                'country' => 'Colombia',
                'role' => 'user',
            ],

            [
                'employee_number' => '419',
                'name' => 'Miguel Salvador',
                'last_name' => 'Torres Borges',
                'email' => 'miguelt@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10450',
                'name' => 'Minerva',
                'last_name' => 'Martinez Parra',
                'email' => 'minervam@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '3629',
                'name' => 'Miriam',
                'last_name' => 'Zepeda Magaña',
                'email' => 'gteadminbjx@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '800',
                'name' => 'Natalia II MERA U (2)',
                'last_name' => 'Aguirre De La Torre',
                'email' => 'nataliaat@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '12209',
                'name' => 'Omar Alejandro',
                'last_name' => 'Soto Frias',
                'email' => 'alejandro.soto@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '836',
                'name' => 'Oscar Antonio',
                'last_name' => 'Aleman',
                'email' => 'oscar.antonio@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '12837',
                'name' => 'Paola Araceli',
                'last_name' => 'Martinez Alor',
                'email' => 'paolam@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Patrick',
                'last_name' => 'Miele',
                'email' => 'patrickm@meracorporation.com',
                'country' => 'Estados Unidos',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Rafael',
                'last_name' => 'Aguirre De La Torre',
                'email' => 'rafaelat@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '10753',
                'name' => 'Rafael',
                'last_name' => 'Aguirre Gómez',
                'email' => 'mera.ceo@gmail.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '1092',
                'name' => 'Ricardo',
                'last_name' => 'Rios Ortega',
                'email' => 'ricardor@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '29',
                'name' => 'Ricardo Rafael',
                'last_name' => 'Campos Carlos',
                'email' => 'ricardoc@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '4164',
                'name' => 'Ruben Alejandro',
                'last_name' => 'Dominguez Hernandez',
                'email' => 'alejandrod@promoexitos.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '220',
                'name' => 'Sabina Del Socorro',
                'last_name' => 'Chi Canul',
                'email' => 'sabinac@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => '696',
                'name' => 'Sergio Arturo',
                'last_name' => 'Menchaca Ramirez',
                'email' => 'sergiom@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

            [
                'employee_number' => null,
                'name' => 'Viviana',
                'last_name' => 'Villamil',
                'email' => 'vivianav@meramexair.com',
                'country' => 'Ecuador',
                'role' => 'user',
            ],

            [
                'employee_number' => '128',
                'name' => 'Wendy Guadalupe',
                'last_name' => 'Chan Tziu',
                'email' => 'wendyc@meracorporation.com',
                'country' => 'México',
                'role' => 'user',
            ],

        ];


        $allUsers = array_merge(
            $superAdmins,
            $admins,
            $users
        );


        foreach ($allUsers as $data) {

            $user = User::firstOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'employee_number' => $data['employee_number']
                        ?? $generateEmployeeNumber(),

                    'name' => $data['name'],

                    'last_name' => $data['last_name'],

                    'country' => $data['country'],

                    'password' => Hash::make('MeraIgnite2026_'),

                    'status_id' => $statusActive->id,
                ]
            );


            $user->syncRoles(
                $data['role'] ?? 'user'
            );
        }
    }
}
