<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\ProductWish;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductWishlistController extends Controller
{
    public function wishlist(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = ProductWish::where('user_id', $userId)->with('products')->get();

        return ResponseHelper::Output('success', $data, 200);
    }

    public function createWishlist(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = ProductWish::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $request->product_id],
            ['user_id' => $userId, 'product_id' => $request->product_id]
        );

        return ResponseHelper::Output('success', $data, 200);
    }

    public function removeWishlist(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = ProductWish::where(['user_id' => $userId, 'product_id' => $request->product_id])->delete();

        return ResponseHelper::Output('success', $data, 200);
    }
}
