<?php

namespace App\Http\Controllers;

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
    public function find(string $name)
    {
        $name = preg_replace('/[^a-zA-Z\d\-\_]/', '', $name);

        if ($response = Structure::findTemplate($name)) {
            return $response;
        }

        return response('[]', 404)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Returns data for structure
     */
    public function data(Request $request, string $name)
    {
        $name = preg_replace('/[^a-zA-Z\d\-\_]/', '', $name);

        // string interval
        $period = $request->post('period') ?? null; // TODO: need a sanitizing

        // datetime intervals
        $start = $request->post('start') ?? null; // TODO: need a sanitizing
        $stop = $request->post('stop') ?? null; // TODO: need a sanitizing

        $filter = $period ? $period : [$start, $stop];

        if ($response =  Structure::findDataForTemplate($name, $filter)) {
            return $response;
        }


        return response('[]', 404)
            ->header('Content-Type', 'application/json');
    }
}
