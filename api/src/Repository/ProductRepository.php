<?php

namespace App\Repository;

use App\Entities\Product;
use App\System\Datebase\DoctrineManager;

class ProductRepository {

    /**
     * @var DoctrineManager
     */
    private $enm;

    /**
     * ProductRepository constructor.
     * @param DoctrineManager $enm
     */
    public function __construct(DoctrineManager $enm)
    {
        $this->enm = $enm->getEntityManager();
    }

    /**
     * @param $product
     */
    public function save($product)
    {
        $this->enm->persist($product);
        $this->enm->flush();
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function findByIds(array $ids)
    {
        return $this->enm->getRepository(Product::class)->findById($ids);
    }

}