<?php

use Illuminate\Database\Seeder;

class NumberRecTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('number_recs')->insert([
            ['block_id' => 1,'source_id' => 3, 'content' => 5], // id:1
            ['block_id' => 3,'source_id' => 3, 'content' => 40], // id:2
            ['block_id' => 4,'source_id' => 1, 'content' => 27], // id:3
        ]);
    }
}
