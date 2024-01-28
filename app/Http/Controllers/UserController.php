<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OtpMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
    public function userLogin( Request $request ): JsonResponse {
        try {
            // $rules = [
            //     'email' => 'required|email',
            // ];

            // $validator = Validator::make( $request->all(), $rules );

            // if ( $validator->fails() ) {
            //     return ResponseHelper::Output( 'failed', $validator->errors()->first(), 200 );
            // }

            $email   = $request->email;
            $otp     = rand( 100000, 999999 );
            $details = ['code' => $otp];
            Mail::to( $email )->send( new OtpMail( $details ) );

            User::updateOrCreate( ['email' => $email], ['email' => $email, 'otp' => $otp] );

            return ResponseHelper::Output( 'success', "A 6 digits otp code has been sent to your email", 200 );
        } catch ( Exception $e ) {
            return ResponseHelper::Output( 'failed', $e, 200 );
        }
    }

    public function verifyLogin( Request $request ): JsonResponse {
        // $rules = [
        //     'email' => 'required|email',
        //     'otp'   => 'required|min:6',
        // ];

        // $validator = Validator::make( $request->all(), $rules );

        // if ( $validator->fails() ) {
        //     return ResponseHelper::Output( 'failed', $validator->errors()->first(), 200 );
        // }

        $email = $request->email;
        $otp   = $request->otp;

        $verification = User::where( 'email', $email )->where( 'otp', $otp )->first();

        if ( $verification ) {
            User::where( 'email', $email )->where( 'otp', $otp )->update( ['otp' => '0'] );

            $token = JWTToken::createToken( $email, $verification->id );

            return ResponseHelper::Output( 'success', "", 200 )->cookie( 'token', $token, 60 * 60 * 24 );
        } else {
            return ResponseHelper::Output( 'failed', null, 401 );
        }
    }

    public function userLogout() {
        return redirect( '/userLogin' )->cookie( 'token', '', -1 );
    }
}