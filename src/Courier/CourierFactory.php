<?php


namespace App\Courier;


use App\Metin2Api\ItemApi;

class CourierFactory {

    protected $prototypeMap = array();
    /** @param CourierInterface[] $couriers */
    public function __construct(array $couriers){
        foreach($couriers as $courier){
            if($courier instanceof CourierFactoryAwareInterface){
                $courier->injectFactory($this);
            }
            $this->prototypeMap[$courier::getTargetType()] = $courier;
        }

    }

    public function createFromType(string $type): CourierInterface{
        if(!isset($this->prototypeMap[$type])) return null;
        return clone $this->prototypeMap[$type];
    }
}