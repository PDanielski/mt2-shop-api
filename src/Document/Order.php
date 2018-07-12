<?php


namespace App\Document;

use App\Request\OrderRequest;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="orders") */
class Order {
    /** @MongoDB\Id() */
    protected $id;

    /** @MongoDB\ObjectId() */
    protected $item;

    /** @MongoDB\Field(type="integer") */
    protected $count;

    /** @MongoDB\Field(type="string") */
    protected $inventoryUsed;

    /** @MongoDB\Field(type="string") */
    protected $currencyUsed;

    /** @MongoDB\Field(type="date") */
    protected $time;

    /** @MongoDB\Field(type="integer") */
    protected $totalPrice;

    /** @MongoDB\Field(type="hash") */
    protected $extra;
    /** @MongoDB\Field(type="integer") */
    protected $userId;

    static function fromOrderRequest(OrderRequest $orderRequest){
        $order = new Order();
        $order->setItem($orderRequest->getItemId());
        $order->setInventoryUsed($orderRequest->getInventoryUsed());
        $order->setCount($orderRequest->getCount());
        $order->setTime($orderRequest->getTime());
        $order->setCurrencyUsed($orderRequest->getCurrencyUsed());
        return $order;
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
    public function getItem() {
        return $this->item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item): void {
        $this->item = $item;
    }

    /**
     * @return mixed
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count): void {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getInventoryUsed() {
        return $this->inventoryUsed;
    }

    /**
     * @param mixed $inventoryUsed
     */
    public function setInventoryUsed($inventoryUsed): void {
        $this->inventoryUsed = $inventoryUsed;
    }

    /**
     * @return mixed
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getCurrencyUsed() {
        return $this->currencyUsed;
    }

    /**
     * @param mixed $currencyUsed
     */
    public function setCurrencyUsed($currencyUsed): void {
        $this->currencyUsed = $currencyUsed;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice() {
        return $this->totalPrice;
    }

    /**
     * @param mixed $price
     */
    public function setTotalPrice($price): void {
        $this->totalPrice = $price;
    }

    /**
     * @return mixed
     */
    public function getExtra() {
        return $this->extra;
    }

    /**
     * @param mixed $extra
     */
    public function setExtra($extra): void {
        $this->extra = $extra;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void {
        $this->userId = $userId;
    }


}