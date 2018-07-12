<?php


namespace App\Controller;


use App\Document\CurrencyPackage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PackagesController extends Controller {
    /**
     * @Route("/packages")
     */
    public function getPackages(){
        $repo = $this->get("doctrine_mongodb")->getRepository(CurrencyPackage::class);
        $packages = $repo->findAll();

        return JsonResponse::fromJsonString($this->get("jms_serializer")->serialize($packages,"json"));
    }
}