<?php


namespace App\Courier;


use App\Courier\Exception\ItemDeliveryException;
use App\Courier\Exception\PlayerRequiredException;
use App\Security\User;

interface CourierInterface {
    /**
     * @param $item
     * @param int $count
     * @param User $user
     * @return bool
     * @throws ItemDeliveryException
     * @throws PlayerRequiredException
     */
    public function send($item, $count, User $user);
    public static function getTargetType();
}