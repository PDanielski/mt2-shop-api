<?php


namespace App\Wallet;


use App\Security\User;

interface WalletProviderInterface {
    public function getByUser(User $user): WalletInterface;
}