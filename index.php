<?php

// 1- creer un tableau de deux catégories: le premier catégorie deux produits et le second pas de produit

$categories = [
   0 => [
            "code" => "code1",
            "nom" => "categorie1",
            "produits" => [
            0 => [
                    "nom" => "produit1",
                    "reference" => "ref1",
                    "prix" => 3000,
                    "quantite" => 5 
                 ],
            1 => [
                    "nom" => "produit2",
                    "reference" => "ref2",
                    "prix" => 2000,
                    "quantite" => 3 
                 ]
            ]
        ],
   1 => [
            "code" => "code2",
            "nom" => "categorie2",
            "produits" => []
        ]
];