<?php

namespace App\Http\Controllers;

use App\Models\NumberRec;
use App\Models\Template;
use Validator;
use App\Providers\StructureServiceProvider as Structure;
use Illuminate\Http\Request as Request;

class TemplateController extends Controller
{
    public function index()
    {
        return Template::all();
    }

    /**
     * Returns structure
     */
    public function find(string $id)
    {
        //$name = preg_replace('/[^a-zA-Z\d\-\_]/', '', $name);
        $id = preg_replace('/[^\d]/', '', $id);

        if ($response = Structure::findTemplate((int) $id)) {
            return $response;
        }

        return response('[]', 404)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Returns data for structure
     */
    public function data(Request $request, string $id)
    {
        $name = preg_replace('/[^a-zA-Z\d\-\_]/', '', $id);

        // string interval
        $period = $request->post('period') ?? null; // TODO: need a sanitizing

        // datetime intervals
        $start = $request->post('start') ?? null; // TODO: need a sanitizing
        $stop = $request->post('stop') ?? null; // TODO: need a sanitizing

        $filter = $start && $stop
            ? [$start, $stop]
            : $period
                ? $period
                : null;

        if ($response =  Structure::findDataForTemplate($id, $filter)) {
            return $response;
        }

        return response('[]', 404)
            ->header('Content-Type', 'application/json');
    }

    public function set(Request $request, string $id)
    {
        $data = json_decode($request->post('json'));

        // filtering template ID and post data

        Structure::insertNumberBlockContent((int) $id, $data->name, $data->value);
    }
}
