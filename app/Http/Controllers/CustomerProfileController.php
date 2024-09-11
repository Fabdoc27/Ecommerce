<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function createProfile(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $request->merge(['user_id' => $userId]);

        $data = CustomerProfile::updateOrCreate(
            ['user_id' => $userId],
            $request->input(),
        );

        return ResponseHelper::Output('success', $data, 200);
    }

    public function getProfile(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = CustomerProfile::where('user_id', $userId)->with('user')->first();

        return ResponseHelper::Output('success', $data, 200);
    }
}
