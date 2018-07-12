<?php


namespace App\Request;


use Symfony\Component\HttpFoundation\Request;

class OrderRequestFactory {

    public function createFromRequest(Request $request){
        $jsonString = $request->getContent();
        $decodedJson = json_decode($jsonString,true);
        $order = new OrderRequest($decodedJson["itemId"], $decodedJson["currencyUsed"], $decodedJson["count"], $decodedJson["inventoryUsed"]);
        return $order;
    }

    public function isValidRequest(Request $request){
        $decodedJson = json_decode($request->getContent(), true);
        if(is_string($request->getContent()) && is_array($decodedJson)) {
            if(isset($decodedJson["itemId"]) && isset($decodedJson["currencyUsed"]) && isset($decodedJson["count"]) && isset($decodedJson["inventoryUsed"])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}