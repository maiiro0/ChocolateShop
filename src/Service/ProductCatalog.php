<?php

namespace App\Service;

final class ProductCatalog
{
    private const array PRODUCTS = [
        ['name' => 'Tablette Noir Intense', 'price' => 5.50, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Pralinés de Montagne', 'price' => 12.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Bonbons'],
        ['name' => 'Coffret Découverte', 'price' => 24.00, 'brand' => 'Douceur de Paris', 'category' => 'Coffrets'],
        ['name' => 'Tablette au Lait', 'price' => 4.80, 'brand' => 'Maison Cacao', 'category' => 'Tablettes'],
        ['name' => 'Ganaches Assorties', 'price' => 16.50, 'brand' => 'Douceur de Paris', 'category' => 'Bonbons'],
        ['name' => 'Coffret des Alpes', 'price' => 29.90, 'brand' => 'Chocolaterie des Alpes', 'category' => 'Coffrets'],
    ];

    public function getProducts(): array
    {
        return self::PRODUCTS;
    }

    public function getBestSellers(): array
    {
        return array_slice(self::PRODUCTS, 0, 3);
    }

    // filtre des produits
    public function getFilteredProducts(string $prixMax, string $categorie, string $marque): array 
    {
        $resultats = [];

        //Pour chaque produits, on pose 3 questions, est ce que le prix, la catégorie ou la marque convient ?
        //La comparaison $variable === '' permet de laisser le champ vide

        foreach($this->getProducts() as $produit) {
            
            // Si le prix est inférieur ou égal au prix maximum, float convertit le prix reçu dans l'URL
            $prixOk = $prixMax === '' || $produit['price'] <= (float)$prixMax;

            $categorieOk = $categorie === '' || $produit['category'] === $categorie;

            $marqueOk = $marque === '' || $produit['brand'] === $marque;

            if ($prixOk && $categorieOk && $marqueOk) {
                $resultats[] = $produit;
            }
        }

        return $resultats;
    }
}
