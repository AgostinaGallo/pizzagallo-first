<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        
        $this->command->info('Usuario Administrador añadido');
        
        if (app()->environment('local')) {
            $this->askForAddSampleData();
        }
    }
   
    protected function askForAddSampleData()
    {
        if ($this->command->confirm('¿Desea agregar todos los datos de prueba?')) {
            $this->call(CategoriesTableSeeder::class);
            $this->command->info('Categorias añadidas!');

            $this->call(PersonsTableSeeder::class);
            $this->command->info('Personas añadidas: empleado, proveedor y cliente!');
           
            $this->call(ArticlesTableSeeder::class);
            $this->command->info('Articulos añadidos!');

        }
    }

}
