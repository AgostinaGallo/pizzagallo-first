<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tipo_persona Empleado
        DB::table('persona')->insert([
            'tipo_persona' => 'Empleado',
            'nombre' => 'Juan Perez',
            'tipo_documento' => 'DNI',
            'num_documento' => '20222555',
            'direccion' => 'Avenida Lavalle 2222',
            'telefono' => '3764112211',
            'email' => 'juanperez@gmail.com',
            'fecha_nacimiento' =>  \Carbon\Carbon::createFromDate(1980,02,22)->toDateString(),
        ]);

        // tipo_persona Proveedor
        DB::table('persona')->insert([
            'tipo_persona' => 'Proveedor',
            'nombre' => 'MaxiConsumo',
            'tipo_documento' => 'CUIT',
            'num_documento' => '301002003005',
            'direccion' => 'Avenida Quaranta Ruta 12',
            'telefono' => '4422255',
            'email' => 'maxiconsumo@gmail.com',
            'fecha_nacimiento' => null,
        ]);

        // tipo_persona Cliente
        DB::table('persona')->insert([
            'tipo_persona' => 'Cliente',
            'nombre' => 'Luciana Balbuena',
            'tipo_documento' => 'DNI',
            'num_documento' => '40748963',
            'direccion' => 'Bolivar 7875 Piso 7 A',
            'telefono' => '3764117788',
            'email' => 'lucianabalbuena@gmail.com',
            'fecha_nacimiento' =>  \Carbon\Carbon::createFromDate(1998,10,05)->toDateString(),
        ]);
    }
}
