<?php

namespace App\Entities;


use Doctrine\Common\Collections\Collection;

/**
 * @Entity()
 * @Table(name="products")
 */
class Product
{
    /**
     * @id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @Column(type="string", name="name", length=100)
     */
    public $name;

    /**
     * @Column(type="integer", name="price")
     */
    public $price;

    /**
     * Product constructor.
     * @param $name
     * @param $price
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

}