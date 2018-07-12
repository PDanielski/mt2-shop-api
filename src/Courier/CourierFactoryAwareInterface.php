<?php


namespace App\Courier;


interface CourierFactoryAwareInterface {
    public function injectFactory(CourierFactory $courierFactory);
}