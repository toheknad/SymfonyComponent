<?php


namespace App\Entities;

/**
 * @Entity()
 * @Table(name="orders")
 */
class Order
{
    /**
     * @id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    /**
     * @Column(type="string", name="status")
     */
    public $status;
    /**
     * @var Product[]
     * @ManyToMany(targetEntity="Product", cascade={"all"},orphanRemoval=true)
     * @JoinTable(name="order_to_product",
     * joinColumns={@JoinColumn(name="order_id", referencedColumnName="id")},
     * inverseJoinColumns={@JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    public $products;

    public function getFullPrice()
    {
        $fullPrice = 0;
        foreach ($this->products as $product) {
            $fullPrice += $product->price;
        }
        return $fullPrice;
    }

}