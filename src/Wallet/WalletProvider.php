<?php


namespace App\Wallet;


use App\Metin2Api\AccountApi;
use App\Metin2Api\PlayerApi;
use App\Metin2Api\PlayerListApi;
use App\Security\User;
use App\Wallet\Currency\BiscuitsCurrency;
use App\Wallet\Currency\GoldCurrency;
use App\Wallet\Currency\WarPointsCurrency;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class WalletProvider implements WalletProviderInterface {
    protected $accountApi;
    public function __construct(AccountApi $accountApi){;
        $this->accountApi = $accountApi;
        return true;
    }

    public function getByUser(User $user): WalletInterface {
        $wallet = new Wallet();
        $goldCurrency = new GoldCurrency($this->accountApi, $user);
        $wallet->addCurrency($goldCurrency);
        $warpointsCurrency = new WarPointsCurrency($this->accountApi, $user);
        $wallet->addCurrency($warpointsCurrency);
        $biscuitCurrency = new BiscuitsCurrency($this->accountApi, $user);
        $wallet->addCurrency($biscuitCurrency);
        return $wallet;
    }
}