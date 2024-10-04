<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $code = 200)
    {
    	$response = [
            'ok' => true,
        ];

        if(! is_null($result))
            $response['data'] = $result;


        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'ok' => false,
            'err' => $error,
        ];


        if(!empty($errorMessages)){
            $response['msg'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}
