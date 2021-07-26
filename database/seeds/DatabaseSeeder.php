<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        if (app()->environment('local')) {
            $this->askForAddSampleData();
        }
    }

    protected function askForAddSampleData()
    {
        if ($this->command->confirm('¿Desea agregar todos los datos de prueba?')) {
            $this->call(CategoriesTableSeeder::class);
            $this->command->info('Categorias añadidas');
        }
    }
}
