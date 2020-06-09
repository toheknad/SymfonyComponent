<?php


namespace App\Services;


use App\Entities\Order;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;

class PaymentOrderService
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
    public function payment(int $id, int $price):? int
    {
        /** @var Order $order */
        $order = $this->orderRepository->findById($id);

        if ($this->verificationPayment($order, $price)) {
            $order->status = 'paid';
            $this->orderRepository->save($order);
            return true;
        }
        return false;
    }

    /**
     * @param $order
     * @param $price
     * @return bool
     */
    private function verificationPayment($order, $price): bool
    {
        if (($order->status === 'new') && ($order->getFullPrice() === $price) && ($this->connectToYa())) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function connectToYa()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://ya.ru');
        return 200 == $res->getStatusCode();
    }
}