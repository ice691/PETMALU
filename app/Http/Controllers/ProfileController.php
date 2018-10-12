<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = Auth::id();

        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$id}",
            'mobile_number' => 'required|digits:11',
            'gender' => 'required|in:male,female',
            'civil_status' => 'required|in:single,married,others',
            'birthdate' => 'required|date|before:today',
            'address' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|same:password',
        ]);

        if ($input['password']) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        Auth::user()->update($input);

        Session::flash('message', [
            'status' => 'success',
            'message' => 'You have successfully updated your profile!',
        ]);

        return response()->json([
            'result' => true,
        ]);
    }
}
