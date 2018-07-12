<?php


namespace App\Document;


interface DiscountInterface {
    public function getNewPrice($price);
}