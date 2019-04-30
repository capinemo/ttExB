<?php

use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blocks')->insert([
            ['name' => 'block11','tmpl_id' => 1, 'block_type' => 'number'], // id:1
            ['name' => 'block12','tmpl_id' => 1, 'block_type' => 'graph'], // id:2
            ['name' => 'block13','tmpl_id' => 1, 'block_type' => 'number'], // id:3
            ['name' => 'block21','tmpl_id' => 2, 'block_type' => 'number'], // id:4
            ['name' => 'block22','tmpl_id' => 2, 'block_type' => 'graph'], // id:5
            ['name' => 'block13','tmpl_id' => 2, 'block_type' => 'graph'], // id:6
        ]);
    }
}
