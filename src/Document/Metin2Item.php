<?php


namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document() */
class Metin2Item extends BaseItem {
    protected static $type = "metin2Item";

    /** @MongoDB\EmbedOne(targetDocument="Metin2ItemData") */
    protected $itemData;

    public function getItemData(){
        return $this->itemData;
    }

    public function setItemData(Metin2ItemData $metin2ItemData){
        $this->itemData = $metin2ItemData;
    }


    public static function getType() {
        return self::$type;
    }
}