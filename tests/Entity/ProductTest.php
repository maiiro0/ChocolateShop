<?php

namespace App\Tests\Entity;

use App\Entity\Product;
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

    public function testHomePageDisplaysTheProductCarouselAndTestimonials(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('[data-product-carousel]');
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
        self::assertCount(
            3,
            $client->getCrawler()->filter('[aria-labelledby="testimonials-title"] figure'),
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
