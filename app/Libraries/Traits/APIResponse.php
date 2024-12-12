<?php

namespace App\Libraries\Traits;

trait APIResponse {
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, array $resetState = []) {

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'reset'   => $resetState
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404) {

        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);

    }

}
