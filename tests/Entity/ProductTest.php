<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\Slider;
use App\Enum\ChocolateEnum;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ProductTest extends WebTestCase
{
    public function testProductCanBeReadImmediatelyAfterCreation(): void
    {
        $product = new Product('Tablette', 4.50, '70 % de cacao', ChocolateEnum::NOIR, 'France', false);

        self::assertSame('Tablette', $product->getName());
        self::assertSame(4.50, $product->getPrice());
        self::assertSame('70 % de cacao', $product->getNote());
        self::assertSame(ChocolateEnum::NOIR, $product->getFamily());
        self::assertSame('France', $product->getCountry());
        self::assertFalse($product->isBestSeller());
        self::assertNull($product->getId());
    }

    public function testHomePageDisplaysTheInMemorySlider(): void
    {
        $slider = (new Slider())
            ->setMessage('À découvrir')
            ->setTitle('Nouveautés chocolatées')
            ->setContent('Une sélection de chocolats à savourer et à partager.')
            ->setButtonLink('/product')
            ->setButtonText('Découvrir la collection');

        self::assertSame('Nouveautés chocolatées', $slider->getTitle());

        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains(
            'section[aria-label="À la une"]',
            'Nouveautés chocolatées',
        );
        self::assertSelectorTextContains(
            'section[aria-labelledby="best-sellers-title"]',
            'Tablette Noir Intense',
        );
        self::assertCount(
            12,
            $client->getCrawler()->filter('[data-product-carousel] [data-carousel-slide]'),
        );
        self::assertSelectorTextContains(
            '[data-product-carousel] [data-carousel-slide]:last-child',
            'Assortiment de fête',
        );
    }

    public function testProductPageDisplaysTheFilterForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/product');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form[method="get"]');
        self::assertSelectorExists('select[name="brand"]');
        self::assertSelectorExists('select[name="brand"] option[value="Maison Cacao"]');
        self::assertSelectorExists('select[name="category"]');
        self::assertSelectorExists('select[name="category"] option[value="Tablettes"]');
        self::assertSelectorExists('input[name="price"]');
        self::assertSelectorTextContains('section[aria-label="Produits"]', 'Tablette Noir Intense');
    }

    public function testProductPageFiltersByBrandCategoryAndMaximumPrice(): void
    {
        $client = static::createClient();
        $client->request('GET', '/product?brand=Maison%20Cacao&category=Tablettes&price=5');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('section[aria-label="Produits"]', 'Tablette au Lait');
        self::assertSelectorTextNotContains('section[aria-label="Produits"]', 'Tablette Noir Intense');
        self::assertSelectorTextNotContains('section[aria-label="Produits"]', 'Pralinés de Montagne');
    }
}
