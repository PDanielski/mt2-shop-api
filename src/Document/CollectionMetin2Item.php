<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document */
class CollectionMetin2Item extends BaseItem {
    protected static $type = "collectionMetin2Item";
    /**
     * @MongoDB\ReferenceMany(
     *   targetDocument="Metin2Item",
     *   discriminatorField="type"
     * )
     */
    protected $records = array();
    /** @MongoDB\Field(type="hash") */
    protected $recordsCount = array();

    public function getRecords(){
        return $this->records;
    }

    public function setRecords($records){
        $this->records = $records;
    }

    public function getRecordsCount() {
        return $this->recordsCount;
    }

    public function getRecordCount($itemId){
        return $this->recordsCount[$itemId]??null;
    }

    public function setRecordsCount($recordsCount): void {
        $this->recordsCount = $recordsCount;
    }

    public static function getType(){
        return self::$type;
    }
}