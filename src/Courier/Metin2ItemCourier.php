<?php


namespace App\Courier;


use App\Courier\Exception\ItemDeliveryException;
use App\Courier\Exception\PlayerRequiredException;
use App\Document\Metin2Item;
use App\Metin2Api\Exception\ApiException;
use App\Metin2Api\ItemApi;
use App\Security\User;

class Metin2ItemCourier implements CourierInterface {
    protected $api;
    protected $itemSent;
    protected $itemSentCount;
    protected $receiver;
    protected $method;
    public function __construct(ItemApi $api) {
        $this->api = $api;
    }

    /**
     * @inheritdoc
     */
    public function send($item, $count = 1,User $user) {
        if(!$item instanceof Metin2Item)
            throw new \InvalidArgumentException("Expected an instance of Metin2Item");
        $itemData = $item->getItemData()->toArray();
        if(isset($itemData["count"])){
            $itemData["count"]*=$count;
        } else {
            $itemData["count"] = $count;
        }
            try {
                if($item->getDestination() == "MALL"){
                    $itemData["owner_id"] = $user->getId();
                    $this->api->insert($itemData,"MALL");
                } else if($item->getDestination() == "INVENTORY"){
                    $playerId = $user->getCurrentPlayerId();
                    if(!$playerId) throw new PlayerRequiredException("The current user has not any player", 4004);
                    $itemData["owner_id"] = $user->getCurrentPlayerId();
                    $this->api->insert($itemData,"INVENTORY");
                } else {
                    if(!$item->getDestination()) $message = "The destination of the Metin2Item is not set";
                    else  $message = $item->getDestination()." is an invalid destination of a Metin2Item";
                    throw new ItemDeliveryException($message,500);
                }
            } catch (ApiException $e){
                throw new ItemDeliveryException($e->getMessage(),$e->getCode(),$e);
            }

        return true;
    }

    public static function getTargetType(){
        return Metin2Item::getType();
    }
}