<?php

namespace App\Http\Controllers\Admin;

use App\AdoptionRequest;
use App\Http\Controllers\Controller;

class AdoptionRequestNotificationController extends Controller
{
    public function __invoke(AdoptionRequest $adoptionRequest)
    {
        $result = $adoptionRequest->notifyRequestorViaSMS();

        if (is_string($result)) {
            return response()->json([
                'result' => false,
                'message' => $result,
            ], 500);
        }

        return response()->json([
            'result' => true,
        ]);
    }
}
