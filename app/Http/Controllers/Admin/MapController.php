<?php

namespace App\Http\Controllers\Admin;

use App\AnimalAdoption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __invoke(Request $request)
    {
        $locations = AnimalAdoption::all();

        return view('admin.map', compact('locations'));
    }
}
