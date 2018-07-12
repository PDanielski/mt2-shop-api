<?php


namespace App\Discount;


class DiscountResult {
    /** @var CurrencyDiscountResult[] */
    protected $results = array();
    public function addResult(CurrencyDiscountResult $result){
        $this->results[$result->getCurrency()] = $result;
    }

    public function get(string $currency){
        return $this->results[$currency]??null;
    }

    public function toArray(){
        $return = array();
        foreach($this->results as $result){
            $return[$result->getCurrency()] = array("originalAmount"=>$result->getOriginalAmount(),"newAmount"=>$result->getNewAmount());
        }
        return $return;
    }

}