<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('admin.reports');
    }
}
