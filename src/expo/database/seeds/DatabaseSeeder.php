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
        $this->call(SourceTableSeeder::class);
        $this->call(TemplateTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(NumberRecTableSeeder::class);
        $this->call(GraphRecTableSeeder::class);
    }
}
