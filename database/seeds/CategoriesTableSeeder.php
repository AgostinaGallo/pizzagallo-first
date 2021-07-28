<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            'nombre' => 'Insumos',
            'descripcion' => 'Productos obtenidos para elaboracion',
            'condicion' => 1,
        ]);

        DB::table('categoria')->insert([
            'nombre' => 'Elaborados para venta',
            'descripcion' => 'Productos para vender elaborados con insumos',
            'condicion' => 1,
        ]);

        DB::table('categoria')->insert([
            'nombre' => 'Reventa',
            'descripcion' => 'Productos comprados para reventa',
            'condicion' => 1,
        ]);
    }
}
