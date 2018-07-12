<?php


namespace App\Controller;


use App\Discount\DiscountProvider;
use App\Document\BaseItem;
use App\Repository\CategoryRepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller {

    /**
     * @Route("/categories", name="getAllCategories", methods={"GET","HEAD"})
     */
    public function getAllCategories(CategoryRepositoryFactory $categoryRepositoryFactory){
        $repo = $categoryRepositoryFactory->createRepository();
        $categories = $repo->findAll();
        if(!is_array($categories)) throw new NotFoundHttpException();

        return JsonResponse::fromJsonString($this->get("jms_serializer")->serialize($categories,"json"));
    }

    /**
     * @Route("/categories/{link}", name="getCategoryByLink")
     */
    public function getCategoryByLink($link, CategoryRepositoryFactory $categoryRepositoryFactory){
        $repo = $categoryRepositoryFactory->createRepository();
        $category = $repo->findOneBy(array('link'=>$link));
        return JsonResponse::fromJsonString(($this->get("jms_serializer")->serialize($category,"json")));
    }
}