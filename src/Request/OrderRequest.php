<?php


namespace App\Request;


class OrderRequest {
    protected $itemId;
    protected $currencyUsed;
    protected $count;
    protected $inventoryUsed;
    protected $time;

    public function __construct($itemId, $currencyUsed, $count = 1, $inventoryUsed = null){
        $this->itemId = $itemId;
        $this->currencyUsed = $currencyUsed;
        $this->count = $count;
        $this->inventoryUsed = $inventoryUsed;
        $this->time = new \DateTime();
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getCurrencyUsed() {
        return $this->currencyUsed;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function getInventoryUsed() {
        return $this->inventoryUsed;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void {
        $this->time = $time;
    }



}