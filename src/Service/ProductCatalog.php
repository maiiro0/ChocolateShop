<?php

namespace App\Service;

final class ProductCatalog
{
    private const BRANDS = [
        'Maison Cacao',
        'Chocolaterie des Alpes',
        'Douceur de Paris',
    ];

    private const CATEGORIES = [
        'Tablettes',
        'Bonbons',
        'Coffrets',
    ];

    private const PRODUCTS = [
        ['name' => 'Tablette Noir Intense', 'price' => 5.50, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Pralinés de Montagne', 'price' => 12.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Bonbons'],
        ['name' => 'Coffret Découverte', 'price' => 24.00, 'brand' => 'Douceur de Paris', 'category' => 'Coffrets'],
        ['name' => 'Tablette au Lait', 'price' => 4.80, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Ganaches Assorties', 'price' => 16.50, 'brand' => 'Douceur de Paris', 'category' => 'Bonbons'],
        ['name' => 'Coffret des Alpes', 'price' => 29.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Coffrets'],
    ];

    /**
     * @return string[]
     */
    public function getBrands(): array
    {
        return self::BRANDS;
    }

    /**
     * @return string[]
     */
    public function getCategories(): array
    {
        return self::CATEGORIES;
    }

    /**
     * @return array<array{name: string, price: float, brand: string, category: string}>
     */
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
