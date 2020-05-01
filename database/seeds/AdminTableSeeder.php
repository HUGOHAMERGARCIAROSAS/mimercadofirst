<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\src\Models\Persona;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nombres' => 'Luis',
            'apellidos' => 'Pino',
            'email' => "admin@pyrushd.com",
            'password' => bcrypt('123456789'),
            'remember_token' => str_random(10),
        ]);

        Admin::create([
            'nombres' => 'gerencia',
            'apellidos' => 'gerencia',
            'email' => 'gerencia@mimercado.delivery',
            'password' => bcrypt('123456789')
        ]);

        Admin::create([
            'nombres' => 'ventas',
            'apellidos' => 'ventas',
            'email' => 'ventas@mimercado.delivery',
            'password' => bcrypt('123456789')
        ]);

    }
}
