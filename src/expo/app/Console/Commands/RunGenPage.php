<?php

namespace App\Console\Commands;

use App\Models\NumberRec;
use Illuminate\Console\Command;

/**
 * Class RunGenPage
 * @package App\Console
 * @description Runs curl for connecting with http://localhost/gen (in docker - nginx container),
 * load number and saves its in NumberRec table
 */
class RunGenPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:gen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open localhost/gen page and get number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ch = curl_init('http://nginx/gen');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $num = curl_exec($ch);

        if (!empty(curl_error($ch))) {
            // save errpr
        }

        if (!preg_match('/^([0-9]+)$/i', $num)) {
            // save error
        }
        /**
         * handling errors
         *   var_dump(curl_error($ch));
         */

        curl_close($ch);

        echo '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';

        $num_rec = new NumberRec();
        $num_rec->block_id = 1;
        $num_rec->source_id = 3;
        $num_rec->content = (int) $num;
        $num_rec->save();
    }
}
