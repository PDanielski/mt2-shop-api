<?php


namespace App\Controller;


use App\Document\CurrencyPackage;
use App\Document\MoneyGrabber;
use App\Document\PaypalTransaction;
use App\Http\JsonErrorResponse;
use App\MoneyGrabber\MoneyGrabberProvider;
use App\Security\UserProvider;
use App\Wallet\WalletProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaypalController extends Controller {

    /** @Route("/login/paypal-ipn") */
    public function ipn(WalletProvider $walletProvider, UserProvider $userProvider){
        try {
            $raw_post_data = file_get_contents('php://input');
            $raw_post_array = explode('&', $raw_post_data);
            $myPost = array();
            foreach ($raw_post_array as $keyval) {
                $keyval = explode ('=', $keyval);
                if (count($keyval) == 2)
                    $myPost[$keyval[0]] = urldecode($keyval[1]);
            }
            $req = 'cmd=_notify-validate';
            if(function_exists('get_magic_quotes_gpc')) {
                $get_magic_quotes_exists = true;
            }
            foreach ($myPost as $key => $value) {
                if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                    $value = urlencode(stripslashes($value));
                } else {
                    $value = urlencode($value);
                }
                $req .= "&$key=$value";
            }
            $ch = curl_init($this->container->getParameter('paypal_link'));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
            $res = curl_exec($ch);
            if( !$res) {
                curl_close($ch);
                exit;
            }

            curl_close($ch);
            if (strcmp ($res, "VERIFIED") == 0) {
                $transaction = new PaypalTransaction();
                foreach($myPost as $field => $value){
                    if(property_exists($transaction,$field)){
                        $transaction->$field = $value;
                    }
                }
                $txn_id=$myPost['txn_id'];
                $custom = $myPost['custom'];
                $custom = explode(',',$custom);
                $accountUsername = $custom[0];
                $receiverId = $custom[1];
                $packageId = $custom[2];

                $currency='EUR';
                $receiverEmail=$myPost['receiver_email'];
                $paymentAmount=$myPost['mc_gross'];
                $payerEmail=$myPost['payer_email'];

                $manager = $this->get("doctrine_mongodb")->getManager();
                $moneyGrabber = $this->get("doctrine_mongodb")->getRepository(MoneyGrabber::class)->findOneBy(array('email'=>$receiverEmail));
                $package = $this->get("doctrine_mongodb")->getRepository(CurrencyPackage::class)->find($packageId);
                $user = $userProvider->loadUserByUsername($accountUsername);
                if(($paymentAmount != $package->getPrice()/100.0)
                    || !$moneyGrabber
                    || !$user
                ){
                    $transaction->status = "REFUSED";
                    $manager->persist($transaction);
                    $manager->flush();
                    return new Response(1);
                }

                $wallet = $walletProvider->getByUser($user);
                foreach($package->getCurrencies() as $currency => $amount){
                    $wallet->deposit($currency, $amount);
                }
                $moneyGrabber->setEarnings($moneyGrabber->getEarnings() + $paymentAmount);
                $manager->persist($moneyGrabber);
                $transaction->status = "OK";
                $manager->persist($transaction);
                $manager->flush();
                return new Response(1);

            } else if (strcmp ($res, "INVALID") == 0) {
                return new Response(0);
            }
        } catch (\Throwable $e) {
            return new Response(0);
        }
    }


    /** @Route("/paypal/link/{packageId}") */
    public function getPaypalActionLinkFromPackageId($packageId, MoneyGrabberProvider $provider){
        $user = $this->getUser();

        $repo = $this->get("doctrine_mongodb")->getRepository(CurrencyPackage::class);
        $package = $repo->find($packageId);
        if($package){
            $url = $this->container->getParameter('paypal_link');
            $moneygrabbers = $this->get("doctrine_mongodb")->getRepository(MoneyGrabber::class)->findAll();
            $poorest = $provider->getPoorest($moneygrabbers);
            $custom = $this->getUser()->getUsername().','.$poorest->getId().','.$package->getId();
            $data = array(
                'cmd' => '_donations',
                'item_name' => $package->__toString(),
                'business' => $poorest->getEmail(),
                'notify_url' => 'https://metin2warlords.net/shop/api/login/paypal-ipn',
                'rm' => 2,
                'amount' => $package->getPrice()/100,
                'custom' => $custom,
                'currency_code' => 'EUR',
                'country' => 'IT'
            );

            $url.='?'.http_build_query($data);
            return new JsonResponse($url);
        }
        return new JsonErrorResponse(4127, "package not found");
    }

}