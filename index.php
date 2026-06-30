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

// 4 Ajouter un produit a une categorie
// 4 - 1 Rechercher une catégorie a partir de son code
$cateEstPresent = false;

$codePourRecherche = readline("entre un code Pour la recherche: ");

foreach ($categories as $key => $value) {
        if ($value["code"] === $codePourRecherche) {
            $cateEstPresent = true;
        }

    // 4 - 2 Saisir les informations du produits

    if($cateEstPresent){

    do {
        $referenceEstUnik=true;
        $reference = readline("entre une reference pour le produit : ");
        if($reference !== ""){
            foreach ($categories as $categorie) {

                foreach ($categorie["produits"] as $produit) {
                    if($produit["reference"]===$reference)
                    {
                        $referenceEstUnik = false;
                        break;
                    }
                }
                }
                if(!$referenceEstUnik){
                    echo "le reference doit etre unique\n";
                }
        }
        else{
            echo "il faut remplir le champ\n";
            $referenceEstUnik=false;
        }
    } while (!$referenceEstUnik);

    do {
        $nomProduit = readline("entre un nom pour le produit : ");
        if($nomProduit === ""){
            echo "il faut remplir le champ\n";   
        }
    } while ($nomProduit === "");

    do {
        $prixProduit = (int)readline("entre un prix pour le produit : ");
        if($prixProduit <=0){
            echo "le prix doit etre superieur a 0 et il faut remplir le champ\n";   
        }
    } while ($prixProduit<=0);

    do {
        $qteProduit = (int)readline("entre une quantité pour le produit : ");
        if($qteProduit <=0){
            echo "la quantité doit etre superieur a 0 et il faut remplir le champ\n";   
        }
    } while ($qteProduit<=0);


    $produit = [
                    "nom" => $nomProduit,
                    "reference" => $reference,
                    "prix" => $prixProduit,
                    "quantite" => $qteProduit 
                 ];
    $categories[$key]["produits"][]=$produit;
    
    
    break;
    }
    }
    var_dump($categories);
    
if (!$cateEstPresent) {
    echo "le code est introuvable\n";
}
