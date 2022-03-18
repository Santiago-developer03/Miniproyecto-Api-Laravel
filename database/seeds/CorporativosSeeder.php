<?php

use App\tw_corporativos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorporativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); 
        DB::table('tw_corporativos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        factory(tw_corporativos::class, 10)->create();
    }
}
