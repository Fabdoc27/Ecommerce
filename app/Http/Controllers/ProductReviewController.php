<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\ProductReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductReviewController extends Controller {
    public function productReview( Request $request ): JsonResponse {
        $data = ProductReview::where( 'product_id', $request->product_id )
            ->with( ['review' => function ( $query ) {
                $query->select( 'id', 'cust_name' );
            }] )->get();
        return ResponseHelper::Output( 'success', $data, 200 );
    }

    public function createReview( Request $request ): JsonResponse {
        $userId  = $request->header( 'id' );
        $profile = CustomerProfile::where( 'user_id', $userId )->first();

        if ( $profile ) {
            $request->merge( ['customer_id' => $profile->id] );
            $data = ProductReview::updateOrCreate(
                ['customer_id' => $profile->id, 'product_id' => $request->input( 'product_id' )],
                $request->input()
            );

            return ResponseHelper::Output( 'success', $data, 200 );
        } else {
            return ResponseHelper::Output( 'failed', "Customer profile not exists", 200 );
        }
    }
}