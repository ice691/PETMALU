<?php

namespace App\Http\Controllers\User;

use App\AnimalImpound;
use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Http\Request;

class AnimalImpoundController extends BaseController
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
            'update' => [
                'animal_type' => 'required|string|in:feline,canine,others',
                'name' => 'required|string|max:200',
                'description' => 'required|string',
                'sex' => 'required|in:male,female',
                'vaccination_status' => 'boolean',
                'photo' => 'image',
            ],
        ];
    }

    public function beforeStore()
    {
        $this->validatedInput['submitted_by'] = Auth::id();
        $this->validatedInput['vaccination_status'] = (bool) $this->request->vaccination_status;
    }

    public function afterStore($resource)
    {
        $resource->photo = $this->request->file('photo')->store(
            "photos/impound/{$resource->id}", 'public'
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
        $this->validatedInput['vaccination_status'] = (bool) $this->request->vaccination_status;
        if (!$this->request->hasFile('photo')) {
            unset($this->validatedInput['photo']);
        }
    }
}
