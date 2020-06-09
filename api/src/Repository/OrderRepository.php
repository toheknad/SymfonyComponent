<?php


namespace App\Repository;


use App\Entities\Order;
use App\Entities\Product;
use App\System\Datebase\DoctrineManager;

class OrderRepository
{
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
     * @param $order
     */
    public function save($order)
    {
        $this->enm->persist($order);
        $this->enm->flush();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->enm->getRepository(Order::class)->find($id);
    }
}