<?php

namespace App\Http\Controllers\User;

use App\AdoptionRequest;
use App\Http\Controllers\BaseController;
use App\Pet;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdoptionRequestController extends BaseController
{
    protected $resourceModel;
    protected $request;

    public function __construct(AdoptionRequest $model, Request $request)
    {
        parent::__construct();
        $this->resourceModel = $model;
        $this->request = $request;
        $this->validationRules = [
            'store' => $this->storeActionValidator(),
            'update' => $this->updateActionValidator(),
        ];
    }

    public function beforeCreate()
    {
        $this->viewData['pet'] = Pet::with('owner')->find($this->request->pet_id);
    }

    public function beforeStore()
    {
        $this->validatedInput['user_id'] = Auth::id();
    }

    public function beforeUpdate()
    {

    }

    public function beforeIndex($query)
    {
        $query->whereUserId(Auth::id())->with('pet');
    }

    protected function validationArray()
    {

    }

    protected function storeActionValidator()
    {
        return [
            'adoption_purpose' => 'required|string',
            'agreement' => 'accepted',
            'pet_id' => [
                'required',
                Rule::exists('pets', 'id')->where(function ($where) {
                    $where->whereRegistrationStatus('approved')
                        ->whereNotExists(function ($whereNotExists) {
                            $whereNotExists->select(DB::raw(1))
                                ->from('adoption_requests')
                                ->whereRaw('adoption_requests.pet_id = pets.id')
                                ->whereRequestStatus('approved');
                        });
                }),
            ],
        ];
    }

    public function updateActionValidator()
    {
        return [
            'id' => 'required',
        ];
    }
}
