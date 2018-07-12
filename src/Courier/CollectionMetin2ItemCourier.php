<?php


namespace App\Courier;



use App\Courier\Exception\ItemDeliveryException;
use App\Courier\Exception\PlayerRequiredException;
use App\Document\CollectionMetin2Item;
use App\Document\Metin2Item;
use App\Metin2Api\Exception\ApiException;
use App\Metin2Api\ItemsApi;
use App\Security\User;
use Doctrine\Common\Util\Debug;

class CollectionMetin2ItemCourier implements CourierInterface, CourierFactoryAwareInterface {
    /** @var CourierFactory */
    protected $courierFactory;
    protected $api;
    public function __construct(ItemsApi $api) {
        $this->api = $api;
    }

    /**
     * @param $item
     * @param int $count
     * @param User $user
     * @return bool
     * @throws ItemDeliveryException
     */
    public function send($item, $count, User $user) {
        if(!$item instanceof CollectionMetin2Item)
            throw new \InvalidArgumentException("The item should be an instance of CollectionItem");

        $records = $item->getRecords();

        $whereToSend = $item->getDestination();
        if($whereToSend == "MALL"){
            $ownerId = $user->getId();
        } else if($whereToSend == "INVENTORY"){
            $ownerId = $user->getCurrentPlayerId();
            if(!$ownerId)
                throw new ItemDeliveryException("The current user has no players",4004);
        } else
            throw new ItemDeliveryException(4500,"Invalid destination");

        $items = array();
        for($i = 0; $i<$count;$i++){
            foreach($records as $record ){
                if(!$record instanceof Metin2Item )
                    throw new \InvalidArgumentException("The CollectionMetin2Item should have only Metin2Items");
                $toSend = array();
                $toSend["count"] = $item->getRecordCount($record->getId())?:1;
                if($record->isStackable()){
                    $items[] = array_merge($toSend,$record->getItemData()->toArray());
                } else {
                    for($s = 0;$s < $toSend["count"];$s++){
                        $items[] = $record->getItemData()->toArray();
                    }
                }

            }
        }
        if($items){
            try {
                $this->api->insertMany($ownerId,$whereToSend,$items);
            } catch (ApiException $e){
                throw new ItemDeliveryException($e->getMessage(),$e->getCode(),$e);
            }
        }
        return true;

    }

    public function injectFactory(CourierFactory $courierFactory) {
        $this->courierFactory = $courierFactory;
    }

    public static function getTargetType() {
        return CollectionMetin2Item::getType();
    }

}