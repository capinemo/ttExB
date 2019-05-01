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
                'content' => '{"2019-05-01 22:10:12":10, "2019-05-01 22:40:12":55}',
                'graph_type' => 'line',
                'graph_start' => '2019-05-01 22:10:12',
                'graph_finish'=>'2019-05-01 22:40:12'
            ], // id:1
            [
                'block_id' => 5,
                'source_id' => 1,
                'content' => '{"2019-05-01 20:10:12":40, "2019-05-01 20:30:12":60}',
                'graph_type' => 'line',
                'graph_start' => '2019-05-01 20:10:12',
                'graph_finish'=>'2019-05-01 20:30:12'
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
