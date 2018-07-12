<?php


namespace App\Repository;


use Symfony\Bridge\Doctrine\ManagerRegistry;
use App\Document\Category;
class CategoryRepositoryFactory {
    protected $registry;
    protected $discountProvider;
    public function __construct(ManagerRegistry $registry){
        $this->registry=$registry;
    }
    public function createRepository(){
        $repo = $this->registry->getRepository(Category::class);
        return $repo;
    }
}