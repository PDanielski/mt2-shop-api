<?php


namespace App\Discount;


use App\Document\BaseDiscount;
use App\Document\ItemShopItemInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class DiscountProvider {
    protected $repository;
    public function __construct(ManagerRegistry $registry){
        $this->repository = $registry->getRepository(BaseDiscount::class);
    }
    public function calculateFromItem(ItemShopItemInterface $item){
        $prices = $item->getPrices();

        $itemDiscount = $this->repository->findOneBy(array('targetId'=>new \MongoId($item->getId()),'targetType'=>"item"));
        if($item->getCategory())
            $categoryDiscount = $this->repository->findOneBy(array('targetId'=>new \MongoId($item->getCategory()->getId()),'targetType'=>"category"));
        $result = new DiscountResult();

        foreach($prices as $currency => $price){
            $newPrice = $price;

            if($itemDiscount){
                if($itemDiscount->supportsCurrency($currency) && $itemDiscount->isDiscountableNow())
                    $newPrice = $itemDiscount->getNewPrice($newPrice);
            }

            if(isset($categoryDiscount)){
                if($categoryDiscount->supportsCurrency($currency) && $categoryDiscount->isDiscountableNow())
                    $newPrice = $categoryDiscount->getNewPrice($newPrice);
            }

            if($price != $newPrice)
                $result->addResult(new CurrencyDiscountResult($currency,$price,$newPrice));
        }
        return $result;
    }
}