<?php


namespace App\Discount;


class CurrencyDiscountResult {
    protected $currency;
    protected $originalAmount;
    protected $newAmount;

    public function __construct($currency,$originalAmount,$newAmount) {
        $this->currency = $currency;
        $this->originalAmount = $originalAmount;
        $this->newAmount = $newAmount;
    }

    /**
     * @return mixed
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency): void {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getOriginalAmount() {
        return $this->originalAmount;
    }

    /**
     * @param mixed $originalAmount
     */
    public function setOriginalAmount($originalAmount): void {
        $this->originalAmount = $originalAmount;
    }

    /**
     * @return mixed
     */
    public function getNewAmount() {
        return $this->newAmount;
    }

    /**
     * @param mixed $newAmount
     */
    public function setNewAmount($newAmount): void {
        $this->newAmount = $newAmount;
    }


}