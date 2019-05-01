<?php

namespace App\Providers;

use Faker\Provider\DateTime;
use Illuminate\Support\ServiceProvider;
use App\Models\Template;
use App\Models\GraphRec;
use App\Models\NumberRec;

class StructureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function findTemplate(string $name)
    {
        $template = Template::where('name', '=', $name)->first();

        return $template ? $template->load('blocks') : [];
    }

    public static function findDataForTemplate(string $name, $period = null): array
    {
        $template = static::findTemplate($name);

        if (!$template) {
            return [];
        }

        return static::loadData($template->blocks->toArray(), $period);
    }


    public static function loadData(array $blocks, $period = null): array
    {
        $list_of_block_keys = array_column($blocks, 'id');
        $last = self::calcInterval($period);

        $graph = GraphRec::select()
            ->join('blocks', 'blocks.id', '=', 'graph_recs.block_id')
            ->whereIn('block_id', $list_of_block_keys)
            ->where('graph_recs.graph_start', '>=', $last[0])
            ->where('graph_recs.graph_finish', '<=', $last[1])
            ->get()
            ->toArray();

        $number = NumberRec::select()
            ->join('blocks', 'blocks.id', '=', 'number_recs.block_id')
            ->whereIn('block_id', $list_of_block_keys)
            ->where('number_recs.insert_at', '>=', $last[0])
            ->get()
            ->toArray();

        return array_merge($graph, $number);
    }

    /**
     * Calculates specified interval from current time
     * @param $period string|array|null
     *
     * $period string rules ([0-9]*|last)_(second|minute|hour|day)
     * Examples for usage $period in string format:
     * 3_hour
     * 30_minute
     * 1_day (=last_day)
     * 3_second
     *
     * @return array with interval strings
     */
    private static function calcInterval ($period = null): array
    {
        $start = 'now';
        $interval = 'P1D';

        if ($period && is_string($period)) {
            $period_arr = explode('_', $period);

            if (isset($period_arr[0]) && isset($period_arr[1])) {
                $count = $period_arr[0] === 'last' || $period_arr[0] == 0 ? 1 : (int) $period_arr[0];
                $type = $period_arr[1] === 'day' ? 'P' : 'PT';
                $point = ucfirst(substr($period_arr[1], 0, 1));

                $interval = $type . $count . $point;
            }
        }

        if (is_array($period)) {
            return [
                (new \DateTime($period[0]))->format('Y-m-d H:i:s'),
                (new \DateTime($period[1]))->format('Y-m-d H:i:s')
            ];
        } else {
            return [
                (new \DateTime('now'))->sub(new \DateInterval($interval))->format('Y-m-d H:i:s'),
                (new \DateTime('now'))->format('Y-m-d H:i:s')
            ];
        }
    }
}
