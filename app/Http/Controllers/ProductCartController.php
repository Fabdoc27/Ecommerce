<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function cartList(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = ProductCart::where('user_id', $userId)->with('products')->get();

        return ResponseHelper::Output('success', $data, 200);
    }

    public function createCart(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $productId = $request->input('product_id');
        $qty = $request->input('qty');
        $color = $request->input('color');
        $size = $request->input('size');

        $unitPrice = 0;

        $product = Product::where('id', '=', $productId)->first();

        if ($product->discount == 1) {
            $unitPrice = $product->discount_price;
        } else {
            $unitPrice = $product->price;
        }

        $totalPrice = $qty * $unitPrice;

        $data = ProductCart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            [
                'qty' => $qty,
                'color' => $color,
                'size' => $size,
                'price' => $totalPrice,
                'user_id' => $userId,
                'product_id' => $productId,
            ]
        );

        return ResponseHelper::Output('success', $data, 200);
    }

    public function removeCart(Request $request): JsonResponse
    {
        $userId = $request->header('id');
        $data = ProductCart::where('user_id', $userId)->where('product_id', '=', $request->product_id)->delete();

        return ResponseHelper::Output('success', $data, 200);
    }
}
