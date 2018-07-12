<?php


namespace App\Wallet\Currency;


use App\Metin2Api\AccountApi;
use App\Security\User;

class GoldCurrency extends AbstractCurrency implements CurrencyInterface {
    protected $api;
    protected $user;

    public function __construct(AccountApi $api, User $user) {
        $this->api = $api;
        $this->user = $user;
    }

    public function deposit($amount) {
        $this->user->setGold($this->user->getGold()+$amount);
        $this->api->update(array('id'=>$this->user->getId(),'gold'=>$this->user->getGold()));
        //TODO: Exception
    }

    public function withdraw($amount) {
        if($this->user->getGold() < $amount) return false;
        $newAmount = $this->user->getGold() - $amount;
        $this->api->update(array('id'=>$this->user->getId(),'gold'=>$newAmount));
        return true;
        //TODO: Exception
    }

    public function getBalance(){
        return $this->user->getGold();
    }

    public static function getCode() {
        return "gold";
    }

    public function __toString() {
        return self::getCode();
    }
}