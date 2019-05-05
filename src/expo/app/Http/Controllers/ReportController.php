<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports', [
            'report_list' => Template::select('id', 'name')->get(),
        ]);
    }
}
