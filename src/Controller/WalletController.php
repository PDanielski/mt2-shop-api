<?php


namespace App\Controller;


use App\Http\JsonErrorResponse;
use App\Wallet\WalletProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends Controller {

    /** @Route("/my-wallet",name="myWallet", methods={"GET"}) */
    public function getPersonalWallet(WalletProvider $provider){
        if($this->getUser() === null) return new JsonErrorResponse(4403,"You shall not pass!");
        $wallet = $provider->getByUser($this->getUser());
        return new JsonResponse($wallet);
    }
}