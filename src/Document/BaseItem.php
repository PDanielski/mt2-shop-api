<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="items",repositoryClass="App\Repository\ItemRepository")
 * @MongoDB\InheritanceType("SINGLE_COLLECTION")
 * @MongoDB\DiscriminatorField("type")
 * @MongoDB\DiscriminatorMap({"metin2Item"="Metin2Item", "collectionMetin2Item"="CollectionMetin2Item"})
 */
class BaseItem implements ItemShopItemInterface {
    /** @MongoDB\Id() */
    protected $id;
    /** @MongoDB\Field(type="string") */
    protected $name = "";
    /** @MongoDB\Field(type="string") */
    protected $desc = "";
    /** @MongoDB\ReferenceOne(targetDocument="Category",storeAs="id") */
    protected $category;
    /** @MongoDB\Field(type="boolean") */
    protected $isMultilingual = false;
    /** @MongoDB\Field(type="boolean") */
    protected $canBeSold = true;
    /** @MongoDB\Field(type="hash") */
    protected $prices = array();
    /** @MongoDB\Field(type="hash") */
    protected $availableDestinations = array("MALL"=>true,"INVENTORY"=>false);
    /** @MongoDB\ReferenceOne(targetDocument="Icon",storeAs="id") */
    protected $icon = null;
    /** @MongoDB\Field(type="boolean") */
    protected $isStackable = true;
    /** @MongoDB\Field(type="string") */
    protected $teaser;

    protected $discount = array();
    protected static $type = "baseItem";
    protected $destination = "MALL";

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAvailableDestinations(){
        return $this->availableDestinations;
    }

    public function setIsStackable($bool){
        $this->isStackable = $bool;
    }

    public function isStackable(){
        return $this->isStackable;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function isMultilingual() {
        return $this->isMultilingual;
    }

    public function setIsMultilingual($isMultilingual) {
        $this->isMultilingual = $isMultilingual;
    }

    public function canBeSold(){
        return $this->canBeSold;
    }

    public function setCanBeSold($bool){
        $this->canBeSold = $bool;
    }

    public function getPrices() {
        return $this->prices;
    }

    public function getPrice(string $currency){
        return $this->prices[$currency]??null;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount): void {
        $this->discount = $discount;
    }

    public function setPrices($prices) {
        $this->prices = $prices;
    }

    public function getIcon(){
        return $this->icon;
    }

    public function setIcon($icon){
        $this->icon = $icon;
    }

    public function getDestination(){
        return $this->destination;
    }

    public function setDestination($destination){
        if(in_array($destination,$this->getAvailableDestinations())) {
            $this->destination = $destination;
        } else {
            throw new \InvalidArgumentException("The destination ".$destination." is unknown");
        }
    }

    public static function getType(){
        return self::$type;
    }

    public function setTeaser($teaser) {
        $this->teaser = $teaser;
    }
}