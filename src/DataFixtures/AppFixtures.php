<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\ChocolateEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product(
            'Chocolat noir Valrona',
            34.99,
            'Chocolat noir',
            ChocolateEnum::NOIR,
            "Côte d'Ivoire",
            false,
        );

        $manager->persist($product);

        $manager->flush();
    }
}
