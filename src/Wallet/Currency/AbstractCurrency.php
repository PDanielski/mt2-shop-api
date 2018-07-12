<?php


namespace App\Wallet\Currency;


abstract class AbstractCurrency {
    protected $isEnabled = true;

    public function isEnabled(){
        return $this->isEnabled;
    }

    public function enable(){
        $this->isEnabled = true;
    }

    public function disable(){
        $this->isEnabled = false;
    }
}