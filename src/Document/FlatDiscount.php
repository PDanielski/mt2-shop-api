<?php


namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document */
class FlatDiscount extends BaseDiscount {
    protected $type = "flatDiscount";

    public function getNewPrice($price){
        $new = $price - $this->value;
        if($new < 0) $new = 0;
        return $new;
    }

}