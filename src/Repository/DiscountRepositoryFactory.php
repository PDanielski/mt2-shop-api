<?php


namespace App\Repository;


use App\Document\BaseDiscount;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class DiscountRepositoryFactory {
    protected $registry;
    public function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
    }

    public function createRepository(){
        $repo = $this->registry->getRepository(BaseDiscount::class);
        return $repo;
    }
}