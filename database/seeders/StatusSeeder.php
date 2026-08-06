<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::firstOrCreate(['name' => 'Activo']);
        Status::firstOrCreate(['name' => 'Inactivo']);
    }
}
