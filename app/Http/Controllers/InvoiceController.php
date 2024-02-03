<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller {
    public function invoiceList( Request $request ) {
        $userId = $request->header( 'id' );
        return Invoice::where( 'user_id', $userId )->get();
    }
    public function createInvoice( Request $request ) {
        DB::beginTransaction();
        try {
            $userId    = $request->header( 'id' );
            $userEmail = $request->header( 'email' );

            $transactionId  = uniqid();
            $deliveryStatus = "Pending";
            $paymentStatus  = "Pending";

            // customer & shipping details
            $user            = CustomerProfile::where( 'user_id', '=', $userId )->first();
            $customerDetails = "Name : $user->cust_name, Address : $user->cust_add, City : $user->cust_city, Phone : $user->cust_phone";
            $shippingDetails = "Name : $user->ship_name, Address : $user->ship_add, City : $user->ship_city, Phone : $user->ship_phone";

            // payable calculation
            $total    = 0;
            $userCart = ProductCart::where( 'user_id', '=', $userId )->get();
            foreach ( $userCart as $product ) {
                $total = $total + $product->price;
            }

            // vat calculation
            $vat     = ( $total * 3 ) / 100;
            $payable = $total + $vat;

            $invoice = Invoice::create( [
                'total'           => $total,
                'vat'             => $vat,
                'payable'         => $payable,
                'cust_details'    => $customerDetails,
                'ship_details'    => $shippingDetails,
                'tran_id'         => $transactionId,
                'delivery_status' => $deliveryStatus,
                'payment_status'  => $paymentStatus,
                'user_id'         => $userId,
            ] );

            $invoiceId = $invoice->id;

            foreach ( $userCart as $eachProduct ) {
                InvoiceProduct::create( [
                    'qty'        => $eachProduct['qty'],
                    'sale_price' => $eachProduct['price'],
                    'product_id' => $eachProduct['product_id'],
                    'invoice_id' => $invoiceId,
                    'user_id'    => $userId,
                ] );
            }

            $paymentMethod = SSLCommerz::initiatePayment( $user, $payable, $transactionId, $userEmail );

            DB::commit();

            return ResponseHelper::Output( 'success', array( ['paymentMethod' => $paymentMethod, 'payable' => $payable, 'vat' => $vat, 'total' => $total] ), 200 );

        } catch ( Exception $e ) {
            DB::rollBack();
            return ResponseHelper::Output( 'failed', $e, 200 );
        }
    }

    public function invoiceProductsList( Request $request ) {
        $userId    = $request->header( 'id' );
        $invoiceId = $request->invoice_id;

        return InvoiceProduct::where( ['user_id' => $userId, 'invoice_id' => $invoiceId] )->with( 'products' )->get();
    }

    public function paymentSuccess( Request $request ) {
        return SSLCommerz::initiateSuccess( $request->query( 'tran_id' ) );
    }

    public function paymentCancel( Request $request ) {
        return SSLCommerz::initiateCancel( $request->query( 'tran_id' ) );
    }

    public function paymentFailed( Request $request ) {
        return SSLCommerz::initiateFailed( $request->query( 'tran_id' ) );
    }

    public function paymentIPN( Request $request ) {
        return SSLCommerz::initiateIPN(
            $request->input( 'tran_id' ),
            $request->input( 'status' ),
            $request->input( 'val_id' )
        );
    }
}