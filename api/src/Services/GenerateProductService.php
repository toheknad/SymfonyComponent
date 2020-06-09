<?php


namespace App\Services;


use App\Entities\Product;
use App\Repository\ProductRepository;
use App\System\Datebase\DoctrineManager;

class GenerateProductService
{
    /**
     * GenerateProductService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $count
     */
    public function generate(int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $product = new Product(
                $this->randomName(),
                $this->randomPrice()
            );
            $this->productRepository->save($product);
        }
    }

    /**
     * @return string
     */
    private function randomName(): string
    {
        $names = ['Стул','Стол','Кровать','ПК','Футболка','Кружка'];
        return $names[rand(0, count($names)-1)];
    }

    /**
     * @return int
     */
    private function randomPrice(): string
    {
        $prices = [142,2623,5245,10332,154,1111];
        return $prices[rand(0, count($prices)-1)];
    }
}