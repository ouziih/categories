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

// 2 - Afficher tous les catégories qui n'ont pas de produit

foreach ($categories as $categorie) {
    if(empty($categorie["produits"]))
        {
            echo "Nom : ".$categorie["nom"]."\n";
            echo "Code : ".$categorie["code"]."\n";
        }
}

// 3 - Enregistrer une nouvelle categorie
// 3-1 saisir le code obligatoire et unique
// 3-2 saisir le nom obligatoire et unique
// 3-3 les produits sont initialisés vides

$codeEstUnik;

do {
    $codeEstUnik=true;
    $code = readline("entre un code : ");
    if($code !== ""){
        foreach ($categories as $categorie) {
            if($categorie["code"]===$code)
                {
                    $codeEstUnik = false;
                    break;
                }
            }
            if(!$codeEstUnik){
                echo "le code doit etre unique\n";
            }
    }
    else{
        echo "il faut remplir le champ\n";
        $codeEstUnik=false;
    }
} while (!$codeEstUnik);

$nomEstUnik;

do {
    $nomEstUnik=true;
    $nom = readline("entre un nom : ");
    if($nom !== ""){
        foreach ($categories as $categorie) {
            if($categorie["nom"]===$nom)
                {
                    $nomEstUnik = false;
                    break;
                }
            }
            if(!$nomEstUnik){
                echo "le nom doit etre unique\n";
            }
    }
    else{
        echo "il faut remplir le champ\n";
        $nomEstUnik=false;
    }
} while (!$nomEstUnik);

$nouvelleCategorie = [
            "code" => $code,
            "nom" => $nom,
            "produits" => []
        ];

$categories[]=$nouvelleCategorie;
var_dump($categories);