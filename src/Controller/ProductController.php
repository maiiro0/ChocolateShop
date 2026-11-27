<?php

namespace App\Controller;

use App\Service\ProductCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_products')]
    public function index(ProductCatalog $productCatalog): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productCatalog->getProducts(),
        ]);
    }
}
