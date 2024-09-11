<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\ProductSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductSliderController extends Controller
{
    public function productSlider(Request $request): JsonResponse
    {
        $data = ProductSlider::all();

        return ResponseHelper::Output('success', $data, 200);
    }
}
