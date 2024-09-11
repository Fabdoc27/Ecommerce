<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productListByCategory(Request $request): JsonResponse
    {
        $data = Product::where('category_id', $request->id)->with('category', 'brand')->get();

        return ResponseHelper::Output('success', $data, 200);
    }

    public function productListByRemark(Request $request): JsonResponse
    {
        $data = Product::where('remark', $request->remark)->with('brand', 'category')->get();

        return ResponseHelper::Output('success', $data, 200);
    }

    public function productListByBrand(Request $request): JsonResponse
    {
        $data = Product::where('brand_id', $request->id)->with('brand', 'category')->get();

        return ResponseHelper::Output('success', $data, 200);
    }

    public function productDetails(Request $request): JsonResponse
    {
        $data = ProductDetail::where('product_id', $request->id)->with('product', 'product.brand', 'product.category')->get();

        return ResponseHelper::Output('success', $data, 200);
    }
}
