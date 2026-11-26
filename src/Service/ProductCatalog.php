<?php

namespace App\Service;

final class ProductCatalog
{
    private const array BRANDS = [
        'Maison Cacao',
        'Chocolaterie des Alpes',
        'Douceur de Paris',
    ];

    private const array CATEGORIES = [
        'Tablettes',
        'Bonbons',
        'Coffrets',
    ];

    private const array PRODUCTS = [
        ['name' => 'Tablette Noir Intense', 'price' => 5.50, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Pralinés de Montagne', 'price' => 12.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Bonbons'],
        ['name' => 'Coffret Découverte', 'price' => 24.00, 'brand' => 'Douceur de Paris', 'category' => 'Coffrets'],
        ['name' => 'Tablette au Lait', 'price' => 4.80, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Ganaches Assorties', 'price' => 16.50, 'brand' => 'Douceur de Paris', 'category' => 'Bonbons'],
        ['name' => 'Coffret des Alpes', 'price' => 29.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Coffrets'],
    ];


    public function getBrands(): array
    {
        return self::BRANDS;
    }

    public function getCategories(): array
    {
        return self::CATEGORIES;
    }


    public function getProducts(): array
    {
        return self::PRODUCTS;
    }

    public function getBestSellers(): array
    {
        return array_slice(self::PRODUCTS, 0, 3);
    }

    public function getFilteredProducts(?string $brand, ?string $category, ?float $maximumPrice): array
    {
         $filteredProducts = [];

         foreach (self::PRODUCTS as $product) {
             if (null !== $brand && $product['brand'] !== $brand) {
                 continue;
             }

             if (null !== $category && $product['category'] !== $category) {
                 continue;
             }

             if (null !== $maximumPrice && $product['price'] > $maximumPrice) {
                 continue;
             }

             $filteredProducts[] = $product;
         }

         return $filteredProducts;
    }
}
