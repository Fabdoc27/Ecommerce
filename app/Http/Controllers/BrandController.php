<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller {
    public function brandList(): JsonResponse {
        $data = Brand::all();
        return ResponseHelper::Output( 'success', $data, 200 );
    }
}