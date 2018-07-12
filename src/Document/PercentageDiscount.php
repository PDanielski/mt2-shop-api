<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document */
class PercentageDiscount extends BaseDiscount {
    protected $type="percentageDiscount";

    public function getNewPrice($price){
        $new = floor($price - ($price*$this->value));
        if($new < 0) $new = 0;
        return $new;
    }
}