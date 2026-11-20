<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Brand;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_products')]
    public function index(
        Product $product,
        Brand $brand,
        Category $category,
    ): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $product,
            'brands' => $brand,
            'categories' => $category,
        ]);
    }
}
