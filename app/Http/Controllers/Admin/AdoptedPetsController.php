<?php
//
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pet;
use Illuminate\Http\Request;

class AdoptedPetsController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = Pet::when($request->pet_name, function ($q) use ($request) {
            $q->where('pet_name', 'like', "%{$request->pet_name}%");
        })->adopted(
            $request->start_date,
            $request->end_date
        )->profile()->get();

        return view('admin.adopted-pets', [
            'data' => $data,
        ]);
    }

    public function show(Pet $pet)
    {
        $pet->loadAdoptionDetails();

        return view('admin.adopted-pet', [
            'pet' => $pet,
        ]);
    }
}
