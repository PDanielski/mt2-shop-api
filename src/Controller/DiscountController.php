<?php


namespace App\Controller;


use App\Repository\DiscountRepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DiscountController extends Controller {
    /** @Route("/discounts",methods={"GET","HEAD"}) */
    public function getDiscounts(DiscountRepositoryFactory $discountRepositoryFactory){
        $repo = $discountRepositoryFactory->createRepository();
        $discounts = $repo->findAll();
        $res = new JsonResponse($discounts);
        $res->setEncodingOptions($res->getEncodingOptions() | JSON_PRETTY_PRINT);
        return $res;
    }
}