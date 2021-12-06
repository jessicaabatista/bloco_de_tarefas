<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Teste::class,
        ]);
    }
}

class Teste extends Seeder
{
    public function run()
    {
        DB::table('Teste')->insert(array(
            array(
                'Descricao' => 'Teste',
            ),
            array(
                'Descricao' => 'Teste 2',
            ),
        ));
    }
}
