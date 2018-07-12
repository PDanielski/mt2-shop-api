<?php


namespace App\Wallet;


use App\Wallet\Currency\CurrencyInterface;

interface WalletInterface {
    public function getAvailCurrencies();
    public function addCurrency(CurrencyInterface $currency);
    public function getBalance(string $currency);
    public function withdraw(string $currency,$amount);
    public function deposit(string $currency,$amount);
    public function currencyExists(string $currency);
}