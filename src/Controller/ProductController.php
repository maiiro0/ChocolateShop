<?php

namespace App\Controller;

use App\Service\ProductCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_products')]
    public function index(
        Request $request,
        ProductCatalog $productCatalog,
    ): Response {
        $brand = $request->query->get('brand');
        $brand = is_string($brand) && in_array($brand, $productCatalog->getBrands(), true) ? $brand : null;
        $category = $request->query->get('category');
        $category = is_string($category) && in_array($category, $productCatalog->getCategories(), true) ? $category : null;
        $price = $request->query->get('price');

        $maximumPrice = is_numeric($price) && (float) $price >= 0 ? (float) $price : null;

        return $this->render('product/index.html.twig', [
            'products' => $productCatalog->getFilteredProducts($brand, $category, $maximumPrice),
            'brands' => $productCatalog->getBrands(),
            'categories' => $productCatalog->getCategories(),
            'filters' => [
                'brand' => $brand,
                'category' => $category,
                'price' => $maximumPrice,
            ],
        ]);
    }
}
