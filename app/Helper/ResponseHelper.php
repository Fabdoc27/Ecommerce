<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function Output($msg, $data, $code): JsonResponse
    {
        return response()->json(['msg' => $msg, 'data' => $data], $code);
    }
}
