<?php

namespace App\Traits;


use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;

trait Errors
{


    private $response;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response[] = $response;
    }

    public function sendSuccessResponseWithData($result,$msg = "OK")
    {
        return RB::asSuccess()->withData($result)->withMessage($msg)->build();
    }

    public function sendSuccessResponseWithDataAndCode($result,$code,$msg = "OK")
    {
        return RB::asSuccess()->withData($result)->withMessage($msg)->withHttpCode($code)->build();
    }

    public function sendSuccessResponseWithoutData($msg = "OK") {
        return RB::asSuccess()->withMessage($msg)->build();
    }

    public function sendError($error, $code = 404)
    {
        return RB::asError($code)->withMessage($error)->build();
    }

    public function generalError()
    {
        $message = "Something went wrong. Please try again";
        return RB::asError(400)->withMessage($message)->build();
    }

    public function sendErrorWithData($error, $message, $code = 404)
    {
        return RB::asError($code)->withData($error)->withMessage($message)->build();
    }


}

