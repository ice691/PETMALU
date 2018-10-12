<?php

namespace App\Http\Controllers\Admin;

use App\AdoptionRequest;
use App\Http\Controllers\Controller;
use App\Pet;
use DB;
use Illuminate\Http\Request;

class ManagePetAdoptionRequestsController extends Controller
{
    public function index(Pet $pet, Request $request)
    {
        $pet->load('adoptionRequests.requestor');

        $adoptionRequestDropdownFormat = $pet->adoptionRequests->mapWithKeys(function ($req) {
            return [
                $req->id => $req->requestor->name,
            ];
        });

        return view('admin.pet-adoption-requests', compact('pet', 'adoptionRequestDropdownFormat'));
    }

    public function approve($petId, Request $request)
    {
        $input = $request->validate([
            'adoption_request_id' => 'required|exists:adoption_requests,id',
            'photo' => 'required|image',
            'remarks' => 'required|string',
        ]);

        $photoFilePath = $request->file('photo')->store('photos/adoption-remarks', 'public');

        $data = [
            'request_status' => 'approved',
            'proof_of_adoption' => $photoFilePath,
            'adoption_remarks' => $input['remarks'],
            'adopted_at' => now()->format('Y-m-d H:i:s'),
        ];

        DB::transaction(function () use ($data, $input, $petId) {
            AdoptionRequest::whereId($input['adoption_request_id'])->update($data);
            AdoptionRequest::where([
                ['id', '!=', $input['adoption_request_id']],
                ['pet_id', '=', $petId],
            ])->update([
                'request_status' => 'rejected',
            ]);
        });

        return response()->json([
            'result' => true,
        ]);

    }
}
