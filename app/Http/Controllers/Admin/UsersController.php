<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    protected $resourceModel;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        parent::__construct();
        $this->resourceModel = $model;
        $this->request = $request;

        $this->validationRules = [
            'store' => [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'mobile_number' => 'required|digits:11|unique:users,mobile_number',
                'gender' => 'required|in:male,female',
                'civil_status' => 'required|in:single,married,others',
                'birthdate' => 'required|date|before:today',
                'address' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string|same:password',
            ],
            'update' => [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->route('user'),
                'mobile_number' => 'required|digits:11|unique:users,mobile_number,' . $request->route('user'),
                'gender' => 'required|in:male,female',
                'civil_status' => 'required|in:single,married,others',
                'birthdate' => 'required|date|before:today',
                'address' => 'required|string',
                'password' => 'nullable|string|min:6|confirmed',
                'password_confirmation' => 'nullable|string|same:password',
                'login_status' => 'required|boolean',
            ],
        ];
    }

    public function beforeIndex($query)
    {
        return $query->standardUsers();
    }

    public function beforeUpdate()
    {
        $this->validatedInput['disabled_at'] = (bool) $this->validatedInput['login_status']
        ? null
        : now()->format('Y-m-d H:i:s');
    }
}
