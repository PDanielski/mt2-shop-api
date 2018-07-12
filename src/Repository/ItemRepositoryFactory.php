<?php


namespace App\Repository;


use App\Discount\DiscountProvider;
use App\Document\BaseItem;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class ItemRepositoryFactory {
    protected $registry;
    protected $discountProvider;
    public function __construct(ManagerRegistry $registry, DiscountProvider $provider){
        $this->registry=$registry;
        $this->discountProvider = $provider;
    }
    public function createRepository(){
        $repo = $this->registry->getRepository(BaseItem::class);
        $repo->setDiscountProvider($this->discountProvider);
        return $repo;
    }
}