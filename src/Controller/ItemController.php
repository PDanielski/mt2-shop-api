<?php


namespace App\Controller;


use App\Discount\DiscountProvider;
use App\Document\BaseDiscount;
use App\Document\BaseItem;
use App\Http\JsonErrorResponse;
use App\Repository\CategoryRepositoryFactory;
use App\Repository\ItemRepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
class ItemController extends Controller {
    /**
     * @Route("/item/{id}",name="getItem",methods={"GET","HEAD"})
     */
    public function getAction($id, ItemRepositoryFactory $itemRepositoryFactory){
        $repo = $itemRepositoryFactory->createRepository();
        $item = $repo->find($id);
        if(!$item) throw new NotFoundHttpException();
        $data = $this->get("jms_serializer")->serialize($item,"json");
        return JsonResponse::fromJsonString($data);
    }

    /**
     * @Route("/item/{itemId}/category", name="getItemCategory", methods={"GET","HEAD"})
     */
    public function getItemCategory($itemId, ItemRepositoryFactory $itemRepositoryFactory){
        $repo = $itemRepositoryFactory->createRepository();
        $item = $repo->find($itemId);
        return JsonResponse::fromJsonString($this->get("jms_serializer")->serialize($item->getCategory(),'json'));
    }

    /**
     * @Route("item/{itemId}/category", name="updateItemCategory", methods={"PUT"})
     */
    public function updateItemCategory($itemId, ItemRepositoryFactory $itemRepositoryFactory){
        $repo = $itemRepositoryFactory->createRepository();
        $item = $repo->find($itemId);
        if($item){

        }
    }
    /**
     * @Route("/category/{link}",name="getCategoryItems",methods={"GET","HEAD"})
     */
    public function getByCategory($link, CategoryRepositoryFactory $categoryRepositoryFactory,
                                  ItemRepositoryFactory $itemRepositoryFactory){

        $categoryRepo = $categoryRepositoryFactory->createRepository();
        $category = $categoryRepo->findOneBy(array('link'=>$link));
        if($category){
            $repo = $itemRepositoryFactory->createRepository();
            $items = $repo->getByCategoryId($category->getId());
            if(!is_array($items)) throw new NotFoundHttpException();
            return JsonResponse::fromJsonString($this->get("jms_serializer")->serialize($items,"json"));
        } else {
            return new JsonErrorResponse(404,"category not found");
        }




    }

    public function createAction(Request $request){
        $jsonString = $request->getContent();
        $jsonDecoded = json_decode($jsonString);
        $manager = $this->get("doctrine_mongodb")->getRepository(BaseItem::class);

    }
}