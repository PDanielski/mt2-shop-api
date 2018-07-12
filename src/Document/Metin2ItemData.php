<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\EmbeddedDocument() */
class Metin2ItemData {
    /** @MongoDB\Field(type="int") */
    protected $vnum = null;
    /** @MongoDB\Field(type="int") */
    protected $count;
    /** @MongoDB\Field(type="int") */
    protected $ownerId;
    /** @MongoDB\Field(type="string") */
    protected $socket0;
    /** @MongoDB\Field(type="string") */
    protected $socket1;
    /** @MongoDB\Field(type="string") */
    protected $socket2;
    /** @MongoDB\Field(type="string") */
    protected $socket3;
    /** @MongoDB\Field(type="string") */
    protected $socket4;
    /** @MongoDB\Field(type="string") */
    protected $socket5;
    /** @MongoDB\Field(type="string") */
    protected $attrType0;
    /** @MongoDB\Field(type="string") */
    protected $attrType1;
    /** @MongoDB\Field(type="string") */
    protected $attrType2;
    /** @MongoDB\Field(type="string") */
    protected $attrType3;
    /** @MongoDB\Field(type="string") */
    protected $attrType4;
    /** @MongoDB\Field(type="string") */
    protected $attrType5;
    /** @MongoDB\Field(type="string") */
    protected $attrType6;
    /** @MongoDB\Field(type="string") */
    protected $attrValue0;
    /** @MongoDB\Field(type="string") */
    protected $attrValue1;
    /** @MongoDB\Field(type="string") */
    protected $attrValue2;
    /** @MongoDB\Field(type="string") */
    protected $attrValue3;
    /** @MongoDB\Field(type="string") */
    protected $attrValue4;
    /** @MongoDB\Field(type="string") */
    protected $attrValue5;
    /** @MongoDB\Field(type="string") */
    protected $attrValue6;

    public function getVnum() {
        return $this->vnum;
    }

    public function setVnum($vnum) {
        $this->vnum = $vnum;
    }

    public function getOwnerId() {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId): void {
        $this->ownerId = $ownerId;
    }

    public function getSocket0() {
        return $this->socket0;
    }

    public function setSocket0($socket0): void {
        $this->socket0 = $socket0;
    }

    public function getSocket1() {
        return $this->socket1;
    }

    public function setSocket1($socket1): void {
        $this->socket1 = $socket1;
    }

    public function getSocket2() {
        return $this->socket2;
    }

    public function setSocket2($socket2): void {
        $this->socket2 = $socket2;
    }

    public function getSocket3() {
        return $this->socket3;
    }

    public function setSocket3($socket3): void {
        $this->socket3 = $socket3;
    }

    public function getSocket4() {
        return $this->socket4;
    }

    public function setSocket4($socket4): void {
        $this->socket4 = $socket4;
    }

    public function getSocket5() {
        return $this->socket5;
    }

    public function setSocket5($socket5): void {
        $this->socket5 = $socket5;
    }

    public function getAttrType0() {
        return $this->attrType0;
    }

    public function setAttrType0($attrType0): void {
        $this->attrType0 = $attrType0;
    }

    public function getAttrType1() {
        return $this->attrType1;
    }

    public function setAttrType1($attrType1): void {
        $this->attrType1 = $attrType1;
    }

    public function getAttrType2() {
        return $this->attrType2;
    }

    public function setAttrType2($attrType2): void {
        $this->attrType2 = $attrType2;
    }

    public function getAttrType3() {
        return $this->attrType3;
    }

    public function setAttrType3($attrType3): void {
        $this->attrType3 = $attrType3;
    }

    public function getAttrType4() {
        return $this->attrType4;
    }

    public function setAttrType4($attrType4): void {
        $this->attrType4 = $attrType4;
    }

    public function getAttrType5() {
        return $this->attrType5;
    }

    public function setAttrType5($attrType5): void {
        $this->attrType5 = $attrType5;
    }

    public function getAttrType6() {
        return $this->attrType6;
    }

    public function setAttrType6($attrType6): void {
        $this->attrType6 = $attrType6;
    }

    public function getAttrValue0() {
        return $this->attrValue0;
    }

    public function setAttrValue0($attrValue0): void {
        $this->attrValue0 = $attrValue0;
    }

    public function getAttrValue1() {
        return $this->attrValue1;
    }

    public function setAttrValue1($attrValue1): void {
        $this->attrValue1 = $attrValue1;
    }

    public function getAttrValue2() {
        return $this->attrValue2;
    }

    public function setAttrValue2($attrValue2): void {
        $this->attrValue2 = $attrValue2;
    }

    public function getAttrValue3() {
        return $this->attrValue3;
    }

    public function setAttrValue3($attrValue3): void {
        $this->attrValue3 = $attrValue3;
    }

    public function getAttrValue4() {
        return $this->attrValue4;
    }

    public function setAttrValue4($attrValue4): void {
        $this->attrValue4 = $attrValue4;
    }

    public function getAttrValue5() {
        return $this->attrValue5;
    }

    public function setAttrValue5($attrValue5): void {
        $this->attrValue5 = $attrValue5;
    }

    public function getAttrValue6() {
        return $this->attrValue6;
    }

    public function setAttrValue6($attrValue6): void {
        $this->attrValue6 = $attrValue6;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount($count): void {
        $this->count = $count;
    }

    public function toArray(){
        $data = array();
        $data["vnum"] = $this->getVnum();
        if(isset($this->count)) $data["count"] = $this->getCount();
        if(isset($this->ownerId)) $data["owner_id"] = $this->getOwnerId();
        for($n = 0;$n < 7;$n++){
            $method = "getAttrType".$n;
            $field = strtolower(substr($method,3));
            if(isset($this->$field)){
                $data[$field] = $this->$method();
            }
        }
        for($n = 0;$n < 7;$n++){
            $method = "getAttrValue".$n;
            $field = strtolower(substr($method,3));
            if(isset($this->$field)){
                $data[$field] = $this->$method();
            }
        }
        for($n = 0;$n < 6;$n++){
            $method = "getSocket".$n;
            $field = strtolower(substr($method,3));
            if(isset($this->$field)){
                $data[$field] = $this->$method();
            }
        }
        return $data;

    }


}