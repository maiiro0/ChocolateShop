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
        $sliderOne = (new Slider())
            ->setMessage('À découvrir')
            ->setTitle('Nouveautés chocolatées')
            ->setContent('Une sélection de chocolats à savourer et à partager.')
            ->setButtonLink('/product')
            ->setButtonText('Découvrir la collection');

        $sliderTwo = (new Slider())
            ->setMessage('Nos incontournables')
            ->setTitle('Les meilleures douceurs')
            ->setContent('Découvrez les tablettes et bonbons préférés de nos clients.')
            ->setButtonLink('/product')
            ->setButtonText('Voir les best sellers');

        $sliderThree = (new Slider())
            ->setMessage('Offrez du plaisir')
            ->setTitle('Coffrets gourmands')
            ->setContent('Des assortiments raffinés pour toutes les occasions.')
            ->setButtonLink('/product?category=Coffrets')
            ->setButtonText('Découvrir les coffrets');

        return $this->render('home/index.html.twig', [
            'slides' => [$sliderOne, $sliderTwo, $sliderThree],
            'bestSellers' => $productCatalog->getBestSellers(),
        ]);
    }
}
