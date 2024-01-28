<?php
namespace App\Helper;
use App\Models\Invoice;
use App\Models\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz {
    static function initiatePayment( $user, $payable, $transactionId, $userEmail ): array {
        try {
            $sslCommerz = SslcommerzAccount::first();
            $response   = Http::asForm()->post( $sslCommerz->init_url, [
                "store_id"         => $sslCommerz->store_id,
                "store_passwd"     => $sslCommerz->store_passwd,
                "total_amount"     => $payable,
                "currency"         => $sslCommerz->currency,
                "tran_id"          => $transactionId,
                "success_url"      => "$sslCommerz->success_url?tran_id=$transactionId",
                "fail_url"         => "$sslCommerz->fail_url?tran_id=$transactionId",
                "cancel_url"       => "$sslCommerz->cancel_url?tran_id=$transactionId",
                "ipn_url"          => $sslCommerz->ipn_url,
                "cus_name"         => $user->cust_name,
                "cus_email"        => $userEmail,
                "cus_add1"         => $user->cust_add,
                "cus_add2"         => $user->cust_add,
                "cus_city"         => $user->cust_city,
                "cus_state"        => $user->cust_city,
                "cus_postcode"     => $user->cust_postcode,
                "cus_country"      => $user->cust_country,
                "cus_phone"        => $user->cust_phone,
                "shipping_method"  => "YES",
                "ship_name"        => $user->ship_name,
                "ship_add1"        => $user->ship_add,
                "ship_add2"        => $user->ship_add,
                "ship_city"        => $user->ship_city,
                "ship_state"       => $user->ship_city,
                "ship_country"     => $user->ship_country,
                "ship_postcode"    => $user->ship_postcode,
                "product_name"     => "Apple Shop Product",
                "product_category" => "Apple Shop Category",
                "product_profile"  => "Apple Shop Profile",
                "product_amount"   => $payable,
            ] );

            return $response->json( 'desc' );

        } catch ( Exception $e ) {
            return $sslCommerz;
            // return "hello";
        }
    }

    static function paymentSuccess( $transactionId ) {
        Invoice::where( ['tran_id' => $transactionId, 'val_id' => 0] )->update( ['payment_status' => 'Success'] );

        return 1;
    }

    static function paymentCancel( $transactionId ) {
        Invoice::where( ['tran_id' => $transactionId, 'val_id' => 0] )->update( ['payment_status' => 'Cancel'] );

        return 1;
    }

    static function paymentFailed( $transactionId ) {
        Invoice::where( ['tran_id' => $transactionId, 'val_id' => 0] )->update( ['payment_status' => 'Failed'] );

        return 1;
    }

    static function paymentIPN( $transactionId, $status, $validationId ) {
        Invoice::where( ['tran_id' => $transactionId, 'val_id' => 0] )->update( [
            'payment_status' => $status,
            'val_id'         => $validationId,
        ] );

        return 1;
    }
}