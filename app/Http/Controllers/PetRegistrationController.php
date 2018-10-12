<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class PetRegistrationController extends BaseController
{
    protected $resourceModel;
    protected $request;

    public function __construct(AnimalImpound $model, Request $request)
    {
        parent::__construct();
        $this->resourceModel = $model;
        $this->request = $request;
        $this->validationRules = [
            'store' => [
                'animal_type' => 'required|string|in:feline,canine,others',
                'name' => 'required|string|max:200',
                'description' => 'required|string',
                'sex' => 'required|in:male,female',
                'vaccination_status' => 'boolean',
                'photo' => 'image|required',
            ],
        ];
    }
}
