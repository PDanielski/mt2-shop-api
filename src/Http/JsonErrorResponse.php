<?php


namespace App\Http;


use Symfony\Component\HttpFoundation\JsonResponse;

class JsonErrorResponse extends JsonResponse {

    public function __construct($errorCode,$errorMessage) {
        $data = array();
        $data["code"] = $errorCode;
        $data["message"] = $errorMessage;
        parent::__construct($data, 400, array(), false);
    }
}