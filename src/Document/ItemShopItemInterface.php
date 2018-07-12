<?php


namespace App\Document;


interface ItemShopItemInterface {
    public function getId();
    public static function getType();
    public function getName();
    public function getDesc();
    public function isMultilingual();
    public function getPrices();
    public function getCategory();
}