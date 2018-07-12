<?php


namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="packages") */
class CurrencyPackage {
    /** @MongoDB\Id() */
    protected $id;

    /** @MongoDB\Field(type="hash") */
    protected $currencies = array();

    /** @MongoDB\Field(type="integer") */
    protected $price;
    /** @MongoDB\Field(type="string") */
    protected $name;

    /** @MongoDB\Field(type="string") */
    protected $teaser = '';

    public function getPrice(){
        return $this->price;
    }

    public function setCoinsPerCurrency($array){
        $this->currencies = $array;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function __toString() {
        $return = '';
        foreach($this->currencies as $currency => $amount){
            $return .= ' '.$currency . ' '. $amount;
        }
        return $return;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCurrencies() {
        return $this->currencies;
    }

    /**
     * @param mixed $currencies
     */
    public function setCurrencies($currencies): void {
        $this->currencies = $currencies;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTeaser() {
        return $this->teaser;
    }

    /**
     * @param mixed $teaser
     */
    public function setTeaser($teaser): void {
        $this->teaser = $teaser;
    }


}