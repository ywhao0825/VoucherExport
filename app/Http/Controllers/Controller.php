<?php

namespace App\Http\Controllers;

use Request;
use App\Libraries\Traits\APIResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use APIResponse;

    public function returnResponse( $response, $errorCode = 200 ) {

        if( $response->isSuccess() ) {

            return $this->sendResponse( $response->getData(), $response->getMessage());

        } else {

            return $this->sendError( $response->getMessage(), $response->getData(), $errorCode );

        }

    }

}
