<?php


namespace App\Wallet\Currency;


use App\Metin2Api\AccountApi;
use App\Security\User;

class WarPointsCurrency extends AbstractCurrency implements CurrencyInterface {
    protected $api;
    protected $user;

    public function __construct(AccountApi $api, User $user) {
        $this->api = $api;
        $this->user = $user;
    }

    public function deposit($amount){
        $this->user->setWarpoints($this->user->getWarpoints()+$amount);
        $this->api->update(array('id'=>$this->user->getId(),'warpoints'=>$this->user->getWarpoints()));
        //TODO: Exception
    }

    public function withdraw($amount) {
        if($this->user->getWarpoints() < $amount) return false;
        $newAmount = $this->user->getWarpoints() - $amount;
        $this->api->update(array('id'=>$this->user->getId(),'warpoints'=>$newAmount));
        return true;
        //TODO: Exception
    }

    public function getBalance() {
        return $this->user->getWarpoints();
    }

    public static function getCode() {
        return "warpoints";
    }

    public function __toString() {
        return self::getCode();
    }
}