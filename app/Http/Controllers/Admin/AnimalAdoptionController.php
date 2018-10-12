<?php

namespace App\Http\Controllers\Admin;

use App\AnimalAdoption;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class AnimalAdoptionController extends BaseController
{
    protected $resourceModel;
    protected $request;

    public function __construct(AnimalAdoption $model, Request $request)
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
                'area' => 'required|string',
                'area_longitude' => 'required|numeric',
                'area_latitude' => 'required|numeric',
                'vaccination_status' => 'boolean',
                'date_seized' => 'required|date',
                'photo' => 'image|required',
                'status' => 'in:eligible,ineligible',
            ],
            'update' => [
                'animal_type' => 'required|string|in:feline,canine,others',
                'name' => 'required|string|max:200',
                'description' => 'required|string',
                'sex' => 'required|in:male,female',
                'area' => 'nullable|string',
                'area_longitude' => 'nullable|numeric',
                'area_latitude' => 'nullable|numeric',
                'vaccination_status' => 'boolean',
                'date_seized' => 'nullable|date',
                'photo' => 'image',
                'status' => 'nullable|in:eligible,ineligible',
            ],
        ];
    }

    public function beforeStore()
    {
        if ($this->request->status == 'eligible') {
            $this->validatedInput['approved_at'] = date_create()->format('Y-m-d H:i:s');
        }

        if ($this->request->status == 'ineligible') {
            $this->validatedInput['rejected_at'] = date_create()->format('Y-m-d H:i:s');
        }
    }

    public function afterStore($resource)
    {
        $resource->photo = $this->request->file('photo')->store(
            "photos/adoption/{$resource->id}", 'public'
        );

        $resource->save();
    }

    public function afterUpdate($resource)
    {
        if ($this->request->hasFile('photo')) {
            $this->afterStore($resource);
        }
    }

    public function beforeUpdate()
    {
        $this->beforeStore();
        if (!$this->request->hasFile('photo')) {
            unset($this->validatedInput['photo']);
        }
    }
}
