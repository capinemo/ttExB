<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            [
                'source_id' => 3,
                'name' => 'cron_template',
                'data' => '<h1>Cron</h1><h2>Блок 1</h2><div>{{ block11 }}</div>'
                    . '<h2>Блок 2</h2><div>{{ block12 }}</div><h2>Блок 3</h2><div>{{ block13 }}</div>'
            ], // id:1
            [
                'source_id' => 1,
                'name' => 'user_template',
                'data' => '<h1>User</h1><h2>Блок 1</h2><div>{{ block21 }}</div>'
                    . '<h2>Блок 2</h2><div>{{ block22 }}</div><h2>Блок 3</h2><div>{{ block13 }}</div>'
            ], // id:2
        ]);
    }
}
