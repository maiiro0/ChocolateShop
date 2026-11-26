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
        ['name' => 'Tablette Noir Intense', 'price' => 5.50, 'brand' => 'Maison Cacao', 'category' => 'Tablettes', 'image' => 'TabletteNoir.svg'],
        ['name' => 'Pralinés de Montagne', 'price' => 12.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Bonbons', 'image' => 'CoffretPralines.svg'],
        ['name' => 'Coffret Découverte', 'price' => 24.00, 'brand' => 'Douceur de Paris', 'category' => 'Coffrets', 'image' => 'CoffretPralines.svg'],
        ['name' => 'Tablette au Lait', 'price' => 4.80, 'brand' => 'Maison Cacao', 'category' => 'Tablettes', 'image' => 'TabletteNoir.svg'],
        ['name' => 'Ganaches Assorties', 'price' => 16.50, 'brand' => 'Douceur de Paris', 'category' => 'Bonbons', 'image' => 'TruffesCacao.svg'],
        ['name' => 'Coffret des Alpes', 'price' => 29.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Coffrets', 'image' => 'CoffretPralines.svg'],
        ['name' => 'Éclats de noisette', 'price' => 6.20, 'brand' => 'Maison Cacao', 'category' => 'Tablettes', 'image' => 'EclatsNoisette.svg'],
        ['name' => 'Truffes au cacao', 'price' => 14.90, 'brand' => 'Douceur de Paris', 'category' => 'Bonbons', 'image' => 'TruffesCacao.svg'],
        ['name' => 'Palets noirs', 'price' => 9.50, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Bonbons', 'image' => 'TabletteNoir.svg'],
        ['name' => 'Coffret Pralinés maison', 'price' => 22.50, 'brand' => 'Maison Cacao', 'category' => 'Coffrets', 'image' => 'CoffretPralines.svg'],
        ['name' => 'Tablette Origine Pérou', 'price' => 7.00, 'brand' => 'Douceur de Paris', 'category' => 'Tablettes', 'image' => 'EclatsNoisette.svg'],
        ['name' => 'Assortiment de fête', 'price' => 32.00, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Coffrets', 'image' => 'TruffesCacao.svg'],
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
        return self::PRODUCTS;
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
