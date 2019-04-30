<?php

use Illuminate\Database\Seeder;

class GraphRecTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('graph_recs')->insert([
            [
                'block_id' => 2,
                'source_id' => 3,
                'content' => '{"1556646279":10, "1556647379":55}',
                'graph_type' => 'line',
                'graph_start' => '1556646279',
                'graph_finish'=>'1556647379'
            ], // id:1
            [
                'block_id' => 5,
                'source_id' => 1,
                'content' => '{"1556640179":40, "1556646279":60}',
                'graph_type' => 'line',
                'graph_start' => '1556640179',
                'graph_finish'=>'1556646279'
            ], // id:2
        ]);

        DB::table('graph_recs')->insert([
            [
                'block_id' => 6,
                'source_id' => 1,
                'content' => '{"test1":50, "test2":20, "test3":30}',
                'graph_type' => 'pie'
            ], // id:3
        ]);
    }
}
