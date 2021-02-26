<?php

namespace App\Helper;

use App\Entity\OrderCustomer;
use App\Entity\OrderProducts;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderFactory
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ProductsRepository $productsRepository, EntityManagerInterface $entityManager) {
        $this->productsRepository = $productsRepository;
        $this->entityManager = $entityManager;
    }

    public function createOrder(object $convert_json): OrderCustomer
    {       
        $price = 0;
               
        $order = new OrderCustomer(
            new CPF ($convert_json->cpf), 
            new Email ($convert_json->email),
            new CEP ($convert_json->cep)
        );
        
        $order
        ->setName_customer($convert_json->name_customer)
        ->setEmail($convert_json->email)
        ->setCpf($convert_json->cpf)
        ->setCep($convert_json->cep)
        ->setShipping($convert_json->shipping);            
            
        $order->setPrice($price);

        $this->entityManager->persist($order);
        $price = 0;
        foreach ($convert_json->products as $value) {
            $product = $this->productsRepository->find($value["id"]);
            $order_products = new OrderProducts(); 
            $order_products 
                ->setProduct($product)
                ->setOrderCustomer($order)
                ->setPrice($product->getPrice())
                ->setQuantity($value["quantity"]);
                
            $price += $product->getPrice()*$value["quantity"];
            $this->entityManager->persist($order_products);
            $order->getOrderProducts()->add($order_products);
        }
            
        $order->setPrice($price);
        return $order;
    }
}