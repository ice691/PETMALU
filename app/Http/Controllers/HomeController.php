<?php

namespace App\Http\Controllers;

use App\Pet;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Pet::forAdoption();

        $query->when($this->request->species, function ($q) {
            $q->where('species', 'like', "%{$this->request->species}%");
        });

        $query->when($this->request->breed, function ($q) {
            $q->where('breed', 'like', "%{$this->request->breed}%");
        });

        $query->when($this->request->name, function ($q) {
            $q->where('pet_name', 'like', "%{$this->request->name}%");
        });

        return view('welcome', [
            'items' => $query->get(),
        ]);
    }
}
