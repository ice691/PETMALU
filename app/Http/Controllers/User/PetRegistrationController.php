<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Pet;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetRegistrationController extends BaseController
{
    protected $resourceModel;
    protected $request;

    public function __construct(Pet $model, Request $request)
    {
        parent::__construct();
        $this->resourceModel = $model;
        $this->request = $request;
        $this->validationRules = [
            'store' => $this->validationArray(),
            'update' => $this->validationArray(),
        ];
    }

    public function beforeStore()
    {
        $this->validatedInput['created_by'] = Auth::id();
        if ($this->request->hasFile('photo')) {
            $this->validatedInput['photo'] = $this->request->file('photo')->store('photos/pets', 'public');
        }
    }

    public function beforeUpdate()
    {
        if ($this->request->hasFile('photo')) {
            $this->validatedInput['photo'] = $this->request->file('photo')->store('photos/pets', 'public');
        } else {
            unset($this->validatedInput['photo']);
        };
    }

    public function beforeIndex($query)
    {
        $query->whereCreatedBy(Auth::id());
    }

    protected function validationArray()
    {
        $rules = [
            'reason' => 'required',
            'photo' => ['required', 'image', 'max:3072'],
            'ownership' => ['required', Rule::in(['household', 'community'])],
            'habitat' => ['required', Rule::in(['caged', 'leashed', 'roaming', 'house_only'])],
            'species' => ['required', Rule::in(['dog', 'cat', 'others'])],
            'pet_name' => 'required|string',
            'breed' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'color' => 'required|string',
            'sex' => ['required', Rule::in(['male', 'female'])],
            'female_sex_extra' => ['nullable', 'required_if:sex,female', Rule::in(['intact', 'spayed', 'pregnant', 'lactating'])],
            'num_puppies' => ['nullable', 'integer'],
            'tag' => ['nullable', Rule::in(['collar', 'microchip', 'tattoo_code', 'others'])],
            'other_tag_extra' => 'nullable|required_if:tag,others|string',
            'other_animal_contact' => ['required', Rule::in(['frequent', 'seldom', 'never'])],
            'date_vaccinated' => 'nullable|date',
            'vaccinated_by' => 'nullable|required_with:date_vaccinated|string',
            'vaccination_source' => ['nullable', 'required_with:date_vaccinated', Rule::in(['BAI', 'DARFO', 'PLGU', 'MLGU', 'DOH', 'NGO', 'OIE'])],
            'vaccination_type' => ['nullable', 'required_with:date_vaccinated', Rule::in(['anti_rabies', 'others'])],
            'vaccine_stock_number' => 'nullable|required_with:date_vaccinated|string',
            'routine_service_activity' => ['nullable', Rule::in(['castration', 'deworming', 'spaying', 'vitamin_injection', 'others'])],
            'other_routine_service_activity_extra' => 'nullable|required_if:routine_service_activity,others|string',
            'routine_service_remarks' => 'nullable|string',
            'service_type' => 'required|in:pickup,deliver',
        ];

        if ($this->request->isMethod('patch')) {
            $rules['photo'][0] = 'nullable';
        }

        return $rules;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        if ($pet->is('approved')) {
            return redirect()
                ->back()
                ->with('deletionError', 'Cannot delete approved pets.');
        }

        return parent::destroy($request, $id);
    }
}
