<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\AdoptionRequestController as UserAdoptionRequestController;
use App\Pet;

class AdoptionRequestController extends UserAdoptionRequestController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Pet::profile()
            ->forAdoption()
            ->has('adoptionRequests', '>=', 1)
            ->withCount('adoptionRequests');

        $query->when($this->request->species, function ($q) {
            $q->where('species', 'like', "%{$this->request->species}%");
        });

        $query->when($this->request->breed, function ($q) {
            $q->where('breed', 'like', "%{$this->request->breed}%");
        });

        $query->when($this->request->name, function ($q) {
            $q->where('pet_name', 'like', "%{$this->request->name}%");
        });

        $this->viewData['resourceList'] = $query->get();

        return view(
            "{$this->viewBaseDir}.{$this->viewFiles['index']}",
            $this->viewData
        );
    }

    public function updateActionValidator()
    {
        return [
            'request_status' => 'required|in:pending,approved,rejected',
        ];
    }

    public function beforeShow($data)
    {

    }
}
