<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class DisabledUsersController extends Controller
{
    /**
     * Disables a user, preventing it from loggin in
     *
     * @param  User   $user [description]
     * @return Response       [description]
     */
    public function store(User $user)
    {
        $result = $user->setDisabled(true);

        return response()->json([
            'result' => (bool) $result,
        ]);
    }

    /**
     * Enables a user, allowing it to login
     *
     * @param  User   $user [description]
     * @return Response       [description]
     */
    public function destroy(User $user)
    {
        $result = $user->setDisabled(false);

        return response()->json([
            'result' => (bool) $result,
        ]);
    }
}
