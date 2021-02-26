<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity()
 */

class OrderCustomer implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */    
    private $name_customer;
    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $cpf;
    /**
     * @ORM\Column(type="string")
     */
    private $cep;
    /**
     * @ORM\Column(type="float")
     */
    private $shipping;
    /**
     * @ORM\Column(type="float")
     */
    private $price;
           
    /**
     * @ORM\OneToMany(targetEntity="OrderProducts", mappedBy="order_customer")
     */
    private $order_products;
    
    public function __construct($cpf, $email, $cep) 
    { 

        // //CPF
        // $cpf = filter_var($cpf, FILTER_VALIDATE_REGEXP,[
        //     'options' => [
        //         'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
                
        //         ]
        //     ]);
                
        // if ($cpf === false){
        //     echo "Formato do CPF inválido!";
        //     exit();
        // }

        //EMAIL
        // if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        //     echo "Formato do e-mail inválido!";
        //     exit();
        // }

        //CEP
        // $cep = filter_var($cep, FILTER_VALIDATE_REGEXP,[
        //     'options' => [
        //         'regexp' => '/^[0-9]{5}\-[0-9]{3}$/'
                
        //         ]
        //     ]);
                
        // if ($cep === false){
        //     echo "Formato do CEP inválido!";
        //     exit();
        // }
                
        $this->order_products = new ArrayCollection(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName_customer(): ?string
    {
        return $this->name_customer;
    }

    public function setName_customer(string $name_customer): self
    {
        $this->name_customer = $name_customer;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    public function setShipping(float $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrderProducts()
    {
        return $this->order_products;
    }

    // public function addOrderProducts(?OrderProducts $order_products): self
    // {
    //     $this->order_products->add($order_products);

    //     return $this;
    // }
    
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name_customer' => $this->getName_customer(),
            'email' => $this->getEmail(),
            'cpf' => $this->getCpf(),
            'cep' => $this->getCep(),
            'shipping' => $this->getShipping(),
            'price' => $this->getPrice(),   
            'products' => $this->getOrderProducts()->toArray()
        ];
    }
}