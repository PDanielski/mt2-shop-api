<?php


namespace App\Repository;


use App\Discount\DiscountProvider;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\LockMode;

class ItemRepository extends DocumentRepository {
    /** @var DiscountProvider */
    protected $discountProvider;

    public function setDiscountProvider(DiscountProvider $provider){
        $this->discountProvider = $provider;
    }

    public function findOneBy(array $criteria) {
        $item = parent::findOneBy($criteria);
        if(isset($this->discountProvider) && $item){
            $item->setDiscount($this->discountProvider->calculateFromItem($item)->toArray());
        }
        return $item;
    }

    public function findBy(array $criteria, array $sort = null, $limit = null, $skip = null) {
        $items = parent::findBy($criteria, $sort, $limit, $skip);
        if(isset($this->discountProvider) && $items){
            foreach($items as $item){
                $item->setDiscount($this->discountProvider->calculateFromItem($item)->toArray());
            }
        }
        return $items;
    }

    public function find($id, $lockMode = LockMode::NONE, $lockVersion = null) {

        $item =  parent::find($id, $lockMode, $lockVersion);
        if(isset($this->discountProvider) && $item){
            $item->setDiscount($this->discountProvider->calculateFromItem($item)->toArray());
        }
        return $item;
    }

    public function getByCategoryId($id){
        $items= $this->findBy(array('category'=>$id));
        if(isset($this->discountProvider) && $items){
            foreach($items as $item){
                $item->setDiscount($this->discountProvider->calculateFromItem($item)->toArray());
            }
        }
        return $items;
    }
}