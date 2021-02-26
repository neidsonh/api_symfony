<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class OrderProducts implements \JsonSerializable
{
        /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /** One Product has One Shipment. 
     *  @ORM\ManyToOne(targetEntity=OrderCustomer::class, inversedBy="order_products")
     *  @ORM\JoinColumn(nullable=false)
     */ 
    private $order_customer;

    /** One Product has One Shipment. 
     *  @ORM\ManyToOne(targetEntity=Products::class)
     *  @ORM\JoinColumn(nullable=false)
     */ 
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(Products $product): self
    {
        $this->product = $product;

        return $this;
    }
    public function getOrderCustomer(): ?OrderCustomer
    {
        return $this->order_customer;
    }

    public function setOrderCustomer(OrderCustomer $order_customer): self
    {
        $this->order_customer = $order_customer;

        return $this;
    }
    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    // public function setOrderCustomer(int order_customer)
    // {
        
    // }

    public function jsonSerialize()
    {
        return [
            'product' => $this->getProduct(),
            // 'price' => $this->getPrice(),
            'quantity' => $this->getQuantity()
        ];
    }
}
