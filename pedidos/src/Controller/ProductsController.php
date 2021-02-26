<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/products", methods="POST")
     */
    public function newProucts(Request $request): Response
    {
        $body = $request->getContent();
        $convert_json = json_decode($body);

        $product = new Products();
        $product->setSku($convert_json->sku);
        $product->setDescription($convert_json->description);
        $product->setPrice($convert_json->price);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse($product);


        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/ProductsController.php',
        // ]);
    }
}
