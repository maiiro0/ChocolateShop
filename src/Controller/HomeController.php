<?php

namespace App\Controller;

use App\Entity\Slider;
use App\Service\ProductCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductCatalog $productCatalog): Response
    {
        return $this->render('home/index.html.twig', [
            'bestSellers' => $productCatalog->getBestSellers(),
        ]);
    }
}
