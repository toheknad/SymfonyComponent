<?php


namespace App\Services;

use App\Entities\Order;
use App\Entities\Product;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;

class CreateOrderService
{
    private $productRepository;
    private $orderRepository;

    /**
     * CreateProductService constructor.
     * @param ProductRepository $productRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(ProductRepository $productRepository, OrderRepository $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param string $name
     * @param int $price
     */
    public function create(array $ids):? int
    {
        $products = $this->productRepository->findByIds($ids);

        if (!empty($products)) {
            $order = new Order();
            $order->status = "new";
            $order->products = new ArrayCollection($products);
            $result = $this->orderRepository->save($order);
            return $order->id;
        }
        return null;
    }

}