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
                'data' => '<div><h1>Cron</h1><h2>Блок 1</h2><reportComponent id="block11"></reportComponent>'
                    . '<h2>Блок 2</h2><reportComponent id="block12"></reportComponent><h2>Блок 3</h2>'
                    . '<reportComponent id="block13"></reportComponent></div>'
            ], // id:1
            [
                'source_id' => 1,
                'name' => 'user_template',
                'data' => '<div><h1>User</h1><h2>Блок 14</h2><reportComponent id="block21"></reportComponent>'
                    . '<h2>Блок 15</h2><reportComponent id="block22"></reportComponent><h2>Блок 16</h2>'
                    . '<reportComponent id="block13"></reportComponent></div>'
            ], // id:2
        ]);
    }
}
