<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('graph_recs')->truncate();
        DB::table('number_recs')->truncate();
        DB::table('blocks')->truncate();
        DB::table('templates')->truncate();
        DB::table('sources')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(SourceTableSeeder::class);
        $this->call(TemplateTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(NumberRecTableSeeder::class);
        $this->call(GraphRecTableSeeder::class);
    }
}
