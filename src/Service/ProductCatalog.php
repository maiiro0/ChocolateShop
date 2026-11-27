<?php

namespace App\Service;

final class ProductCatalog
{
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

    public function getProducts(): array
    {
        return self::PRODUCTS;
    }

    public function getBestSellers(): array
    {
        return self::PRODUCTS;
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
