<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($data, $message)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
            'status' => 200
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $message, $code)
    {
        $response = [
            'success' => false,
            'error' => $error,
            'message' => $message,
            'status' => $code
        ];
        return response()->json($response, 500);
    }

    public function noRecords(){
        return ['data' => ['No records.']];
    }

    public function noUsers(){
        return ['data' => ['Unregistered user.']];
    }

    public function noPermissions(){
        return ['data' => ['No permisisions.']];
    }
}
