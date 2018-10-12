<?php

namespace App\Http\Controllers\User;

use App\AdoptionRequest;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class CancelAdoptionRequestController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => [
                'required',
                Rule::exists('adoption_requests')->where(function ($q) {
                    $q->whereNull('deleted_at')
                        ->whereUserId(Auth::id())
                        ->whereRequestStatus('pending');
                }),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user.adoption-request.index')
                ->withMessage([
                    'status' => 'danger',
                    'message' => 'Cannot cancel approved requests.',
                ]);
        }

        AdoptionRequest::find($request->id)
            ->delete();

        return redirect()
            ->route('user.adoption-request.index')
            ->withMessage([
                'status' => 'success',
                'message' => 'Adoption request has been cancelled.',
            ]);
    }
}
