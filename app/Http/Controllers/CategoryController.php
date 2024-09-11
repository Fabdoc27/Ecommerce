<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function categoryList(): JsonResponse
    {
        $data = Category::all();

        return ResponseHelper::Output('success', $data, 200);
    }
}
