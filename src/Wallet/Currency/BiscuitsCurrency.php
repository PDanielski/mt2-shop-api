<?php


namespace App\Wallet\Currency;


use App\Metin2Api\AccountApi;
use App\Security\User;

class BiscuitsCurrency extends AbstractCurrency implements CurrencyInterface {
    protected $api;
    protected $user;

    public function __construct(AccountApi $api, User $user) {
        $this->api = $api;
        $this->user = $user;
    }

    public function deposit($amount){
        $this->user->setBiscuits($this->user->getBiscuits()+$amount);
        $this->api->update(array('id'=>$this->user->getId(),'biscuits'=>$this->user->getBiscuits()));
        //TODO: Exception
    }

    public function withdraw($amount) {
        if($this->user->getBiscuits() < $amount) return false;
        $newAmount = $this->user->getBiscuits() - $amount;
        $this->api->update(array('id'=>$this->user->getId(),'biscuits'=>$newAmount));
        return true;
        //TODO: Exception
    }

    public function getBalance() {
        return $this->user->getBiscuits();
    }

    public static function getCode() {
        return "biscuits";
    }

    public function __toString() {
        return self::getCode();
    }
}