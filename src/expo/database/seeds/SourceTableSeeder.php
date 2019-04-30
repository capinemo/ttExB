<?php

use Illuminate\Database\Seeder;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert([
            ['key' => '123','type' => 'user'], // id:1
        ]);

        DB::table('sources')->insert([
            ['link' => 'http://user@generator.site.ru','type' => 'cron'], // id:2
            ['link' => 'http://localhost/gen','type' => 'cron'], // id:3
        ]);
    }
}
