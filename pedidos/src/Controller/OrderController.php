<?php

namespace App\Controller;

use App\Entity\OrderCustomer;
use App\Entity\OrderProducts;
use App\Helper\OrderFactory;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var OrderFactory
     */
    private $order_factory;

    public function __construct(EntityManagerInterface $entityManager, OrderFactory $order_factory, ProductsRepository $productsRepository) {
        $this->entityManager = $entityManager;
        $this->order_factory = $order_factory;
        $this->productsRepository = $productsRepository;
    }


    /**
     * Criar um novo pedido
     * 
     * @Route("/order", methods={"POST"}) 
     */
    public function newOrder(Request $request): Response
    {
        $body = (object) $request->toArray();
        $order = $this->order_factory->createOrder($body);        

        $this->entityManager->persist($order);
        $this->entityManager->flush();
        // var_dump($order);
        // exit();

       return new JsonResponse($order);
    }

    /**
     * Pesquisar todos os pedidos
     * 
     * @Route("/order", methods={"GET"})
     */
    public function searchAll(): Response
    {
        $repository_order = $this
            ->getDoctrine()
            ->getRepository(OrderCustomer::class);

        $order_list = $repository_order->findAll();

        return new JsonResponse($order_list);
    }

    /**
     * Pesquisar os pedidos por ID
     * 
     * @Route("/order/{id}", methods={"GET"})
     */
    public function search(int $id): Response
    {
        $order = $this->searchOrder($id);

        $return_code = is_null($order) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($order, $return_code);

    }

    /**
     * Atualizar um pedido
     * 
     * @Route("/order/{id}", methods={"PUT"})
     */
    // public function updateOrder(int $id, Request $request): Response
    // {

    //     $body = $request->getContent();
    //     $order_send = $this->order_factory->createOrder($body);

    //     $order_exist = $this->searchOrder($id);

    //     if (is_null($order_exist)){
    //         return new Response('',Response::HTTP_NOT_FOUND);
    //     }

    //     $order_exist->name_customer = $order_send->name_customer;
    //     $order_exist->email         = $order_send->email;
    //     $order_exist->cpf           = $order_send->cpf;
    //     $order_exist->cep           = $order_send->cep;
    //     $order_exist->shipping      = $order_send->shipping;
    //     $order_exist->price         = $order_send->price;

    //     $this->entityManager->flush();

    //     return new JsonResponse($order_exist);
    // }

    /**
     * Remover um pedido
     * 
     * @Route("/order/{id}", methods={"DELETE"})
     */

    public function deleteOrder(int $id): Response
    {
        $order = $this->searchOrder($id);
        $this->entityManager->remove($order);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }



    public function searchOrder(int $id)
    {
        $repository_order = $this
        ->getDoctrine()
        ->getRepository(OrderCustomer::class);

        $order = $repository_order->find($id);
        return $order;
    }
}