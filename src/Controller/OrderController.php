<?php


namespace App\Controller;


use App\Courier\CourierFactory;
use App\Courier\Exception\ItemDeliveryException;
use App\Courier\Exception\PlayerRequiredException;
use App\Discount\DiscountProvider;
use App\Discount\DiscountResult;
use App\Document\BaseItem;
use App\Document\Metin2Item;
use App\Document\Order;
use App\Http\JsonErrorResponse;
use App\Request\OrderRequestFactory;
use App\Repository\ItemRepositoryFactory;
use App\Wallet\WalletProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class OrderController extends Controller {

    /**
     * @Route("/order", name="createOrder",methods={"POST"})
     */
    public function createOrder(Request $request,WalletProvider $provider, ItemRepositoryFactory $itemRepositoryFactory,
                                CourierFactory $courierFactory, OrderRequestFactory $orderRequestFactory){

        if($orderRequestFactory->isValidRequest($request)){
            if($this->getUser() === null) return new JsonErrorResponse(4403,"You shall not pass!");

            $orderRequest = $orderRequestFactory->createFromRequest($request);

            $repo = $itemRepositoryFactory->createRepository();
            $item = $repo->find($orderRequest->getItemId());

            if($item){

                if(!$item->canBeSold())
                    return new JsonErrorResponse(4407,"This item can't be sold");

                if(!$item->getPrice($orderRequest->getCurrencyUsed()))
                    return new JsonErrorResponse(4405,"You can't buy this item with your currency");

                if($orderRequest->getInventoryUsed() !== null)
                    $item->setDestination($orderRequest->getInventoryUsed());
                $wallet = $provider->getByUser($this->getUser());

                if(!$wallet->currencyExists($orderRequest->getCurrencyUsed()))
                    return new JsonErrorResponse(4402,"Your wallet is not able to handle the ".$orderRequest->getCurrencyUsed()." currency");

                $balance = $wallet->getBalance($orderRequest->getCurrencyUsed());
                $itemPrice = $item->getPrice($orderRequest->getCurrencyUsed());

                if($item->getDiscount()){
                    $discount = $item->getDiscount();
                    if(isset($discount[$orderRequest->getCurrencyUsed()]))
                        $itemPrice = $discount[$orderRequest->getCurrencyUsed()]["newAmount"];
                }

                if($itemPrice*$orderRequest->getCount() > $balance)
                    return new JsonErrorResponse(4401,"You dont have enough ".$orderRequest->getCurrencyUsed());

                $courier = $courierFactory->createFromType($item::getType());
                if(!$courier)
                    return new JsonErrorResponse(4501,"The is no courier set for: ".$item::getType());

                try {
                    $count = $item->isStackable()?$orderRequest->getCount():1;
                    $courier->send($item,$count,$this->getUser());
                    $wallet->withdraw($orderRequest->getCurrencyUsed(),$itemPrice*$count);

                    $order = Order::fromOrderRequest($orderRequest);
                    $order->setTotalPrice($itemPrice*$count);
                    $order->setUserId($this->getUser()->getId());
                    if($item instanceof Metin2Item){
                        $order->setExtra(array('vnum'=>$item->getItemData()->getVnum()));
                    }
                    $manager = $this->get("doctrine_mongodb")->getManager();
                    $manager->persist($order);
                    $manager->flush();

                    return new JsonResponse($itemPrice*$orderRequest->getCount());
                } catch (PlayerRequiredException $e){
                    return new JsonErrorResponse($e->getCode(),$e->getMessage());
                } catch (ItemDeliveryException $e){
                    return new JsonErrorResponse($e->getCode(),$e->getMessage());
                }

            } else {
                return new JsonErrorResponse(4404,"Item not found");
            }
        } else {
            return new JsonErrorResponse(4400,"Invalid data submitted");
        }
    }
}