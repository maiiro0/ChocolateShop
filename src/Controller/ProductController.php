<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Service\ProductCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
#[Route('/product', name: 'app_products')]
public function index(Request $request, ProductCatalog $productCatalog): Response
{
    $prixMax = $request->query->getString('price');
    $categorie = $request->query->getString('category');
    $marque = $request->query->getString('brand');

    $tousLesProduits = $productCatalog->getProducts();

    return $this->render('product/index.html.twig', [
        'products' => $productCatalog->getFilteredProducts($prixMax, $categorie, $marque),
        //array_column category récupère toutes les categories, et array_unique enlève les doublons
        'categories' => array_unique(array_column($tousLesProduits, 'category')), 
        'brands' => array_unique(array_column($tousLesProduits, 'brand')),
        //les 3 derniers paramètres permettent a Twig de garder les filtres actifs même après le rechargement de la page
        'prixMax' => $prixMax,
        'categorie' => $categorie,
        'marque' => $marque,
    ]);
}
}
