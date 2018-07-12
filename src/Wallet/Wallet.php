<?php


namespace App\Wallet;


use App\Wallet\Currency\CurrencyInterface;

class Wallet implements WalletInterface, \JsonSerializable {
    /** @var CurrencyInterface[] $currencies */
    protected $currencies = array();

    public function getAvailCurrencies() {
        return $this->currencies;
    }

    public function addCurrency(CurrencyInterface $currency) {
        $this->currencies[$currency::getCode()] = $currency;
    }

    public function getBalance(string $currency) {
        if($this->currencyExists($currency))
            return $this->currencies[$currency]->getBalance();
        throw new \InvalidArgumentException("Currency $currency does not exists");
    }

    public function withdraw(string $currency, $amount) {
        if($this->currencyExists($currency))
            return $this->currencies[$currency]->withdraw($amount);
        throw new \InvalidArgumentException("Currency $currency does not exists");
    }

    public function deposit(string $currency, $amount) {
        if($this->currencyExists($currency))
            return $this->currencies[$currency]->deposit($amount);
        throw new \InvalidArgumentException("Currency $currency does not exists");
    }

    public function currencyExists(string $currency){
        if(isset($this->currencies[$currency])) return true;
        return false;
    }

    public function jsonSerialize() {
        $balances = array();
        foreach($this->currencies as $currency => $object) {
            $balances[$currency] = $object->getBalance();
        }
        return $balances;
    }
}