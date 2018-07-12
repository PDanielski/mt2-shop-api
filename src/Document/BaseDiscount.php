<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="discounts")
 * @MongoDB\InheritanceType("SINGLE_COLLECTION")
 * @MongoDB\DiscriminatorField("type")
 * @MongoDB\DiscriminatorMap({"flatDiscount"="FlatDiscount", "percentageDiscount"="PercentageDiscount"})
 */
abstract class BaseDiscount implements DiscountInterface, \JsonSerializable {
    /** @MongoDB\Id() */
    protected $id;
    /** @MongoDB\ObjectId() */
    protected $targetId;
    /** @MongoDB\Field(type="string") */
    protected $targetType;
    /** @MongoDB\Field(type="collection") */
    protected $targetCurrencies = array();
    /** @MongoDB\Field(type="float") */
    protected $value;
    /** @MongoDB\Field(type="date") */
    protected $startTime;
    /** @MongoDB\Field(type="date") */
    protected $endTime;

    protected $type = "baseDiscount";


    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getTargetId() {
        return $this->targetId;
    }

    public function setItemId($targetId): void {
        $this->targetId = $targetId;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value): void {
        $this->value = $value;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime): void {
        $this->startTime = $startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime): void {
        $this->endTime = $endTime;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getTargetType() {
        return $this->targetType;
    }

    public function setTargetType($targetType): void {
        $this->targetType = $targetType;
    }

    public function getTargetCurrencies() {
        return $this->targetCurrencies;
    }

    public function setTargetCurrencies($targetCurrencies) {
        $this->targetCurrencies = $targetCurrencies;
    }

    public function supportsCurrency(string $currency){
        if(!isset($this->targetCurrencies) || empty($this->targetCurrencies)) return true;
        return in_array($currency,$this->targetCurrencies);
    }

    public function isDiscountableNow(){
        $now = new \DateTime();
        if(isset($this->startTime)){
            if($this->startTime > $now)
                return false;
        }
        if(isset($this->endTime)){
            if($this->endTime < $now)
                return false;
        }
        return true;
    }

    public function jsonSerialize() {
        $toSerialize = array();
        $toSerialize["id"] = $this->getId();
        $toSerialize["targetId"] = $this->getTargetId();
        $toSerialize["targetType"] = $this->getTargetType();
        $toSerialize["targetCurrencies"] = $this->getTargetCurrencies();
        $toSerialize["value"] = $this->getValue();
        $toSerialize["startTime"] = $this->getStartTime();
        $toSerialize["endTime"] = $this->getEndTime();
        $toSerialize["type"] = $this->getType();
        return $toSerialize;
    }

    public abstract function getNewPrice($price);
}