<?php


namespace App\Wallet\Currency;


interface CurrencyInterface {
    public static function getCode();
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}