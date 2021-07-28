<?php

use Illuminate\Database\Seeder;
use pizzagallo\Articulo;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categoria_insumos = pizzagallo\Categoria::where('nombre', '=', 'Insumos')->firstOrFail();
        $categoria_elab_venta = pizzagallo\Categoria::where('nombre', '=', 'Elaborados para venta')->firstOrFail();
        $categoria_reventa = pizzagallo\Categoria::where('nombre', '=', 'Reventa')->firstOrFail();

        $articulo_1 = new Articulo();
        $articulo_1->idcategoria = $categoria_insumos->idcategoria;
        $articulo_1->codigo= '01010';
        $articulo_1->nombre= 'Jamon';
		$articulo_1->stock= 20;
        $articulo_1->unidad_medida= 'kilogramos';
        $articulo_1->descripcion= 'Jamon cocido utilizado para elaborar productos';
		$articulo_1->estado='Activo';
        $articulo_1->save();


        $articulo_2 = new Articulo();
        $articulo_2->idcategoria = $categoria_reventa->idcategoria;
        $articulo_2->codigo= '02020';
        $articulo_2->nombre= 'Coca Cola 2.5 lts';
		$articulo_2->stock= 30;
        $articulo_2->unidad_medida= 'unidades';
        $articulo_2->descripcion= 'Gaseosa con azucar de 2.5 litros comprada para revender';
		$articulo_2->estado='Activo'; 
        $articulo_2->save();

        $articulo_3 = new Articulo();
        $articulo_3->idcategoria = $categoria_elab_venta->idcategoria;
        $articulo_3->codigo= '00303';
        $articulo_3->nombre= 'Empanada de Carne horno';
		$articulo_3->stock= 60;
        $articulo_3->unidad_medida= 'unidades';
        $articulo_3->descripcion= 'Empanada elaborada al horno, de carne molida y verduras';
		$articulo_3->estado='Activo'; 
        $articulo_3->save();
    }
}
