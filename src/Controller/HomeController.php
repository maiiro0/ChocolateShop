<?php

namespace App\Controller;

use App\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $slider = (new Slider())
            ->setMessage('À découvrir')
            ->setTitle('Nouveautés chocolatées')
            ->setContent('Une sélection de chocolats à savourer et à partager.')
            ->setButtonLink('/product')
            ->setButtonText('Découvrir la collection');

        return $this->render('home/index.html.twig', [
            'slides' => [$slider],
            'bestSellers' => [],
        ]);
    }
}
