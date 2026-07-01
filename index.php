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

function verifVide(array $categorie):bool{
    return (empty($categorie["produits"]));
}
function afficheMessage(string $msg):void{
    echo $msg;
}
function afficheCategorie(array $categories):void{
    foreach ($categories as $categorie) {
    if(verifVide($categorie))
        {
            
            afficheMessage("Nom : ".$categorie["nom"]."\n");
            afficheMessage("Code : ".$categorie["code"]."\n");
        }
    }
}

afficheCategorie($categories);



// 3 - Enregistrer une nouvelle categorie
// 3-1 saisir le code obligatoire et unique
// 3-2 saisir le nom obligatoire et unique
// 3-3 les produits sont initialisés vides

function recupChamp(string $msg):string{
    return readline($msg);
}

function verifChampVide(string $champ):bool{
    if($champ === "")
        {
            return true;
        }
    return false;
}

function verifUnik(array $tableau, string $element,string $cle):bool{
    foreach ($tableau as $categorie) {
            if($categorie[$cle]===$element)
                {
                    return false;
                }
            }
    return true;
}



function validSaisieChampRef(array $categories, string $cle):string{

    do {
    $testeur;
    $champ = recupChamp("entre un ".$cle." : ");
    if(!verifChampVide($champ)){
      $testeur = verifUnikRef($categories,$champ,$cle);
            if(!$testeur){
                afficheMessage("le ".$cle." doit etre unique\n");
            }
    }
    else{
        afficheMessage("il faut remplir le champ\n");
        $testeur=false;
    }
} while (!$testeur);  
return $champ;  
}


function validSaisieChamp(array $categories, string $cle):string{

    do {
    $testeur;
    $champ = recupChamp("entre un ".$cle." : ");
    if(!verifChampVide($champ)){
      $testeur = verifUnik($categories,$champ,$cle);
            if(!$testeur){
                afficheMessage("le ".$cle." doit etre unique\n");
            }
    }
    else{
        afficheMessage("il faut remplir le champ\n");
        $testeur=false;
    }
} while (!$testeur);  
return $champ;  
}

function enregistreCategorie(array $categorie,array &$categories):void{
    array_push($categories,$categorie);
}

function constructeurDeCategorie(string $code,string $nom,array $produits){
    return [
            "code" => $code,
            "nom" => $nom,
            "produits" => $produits
        ];
}

function rechercheCategorieParCle(array $categories, string $cle, string $valeur): bool | int {
    foreach ($categories as $key => $categorie) {
        if($categorie[$cle] === $valeur)
            {
                return $key;
            }
    }
    return false;

}

function verifReferenceUnique(array $categories, string $reference): bool {
    foreach ($categories as $categorie) {
        foreach ($categorie["produits"] as $produit) {
            if ($produit["reference"] === $reference) {
                return false;
            }
        }
    }
    return true;
}


function validSaisieRef(array $categories): string {
    do {
        $testeur = false;
        $reference = recupChamp("Entre une référence : ");
        if (!verifChampVide($reference)) {
            $testeur = verifReferenceUnique($categories, $reference);
            if (!$testeur) {
                afficheMessage("La référence doit être unique\n");
            }
        } else {
            afficheMessage("Il faut remplir le champ\n");
        }
    } while (!$testeur);
    return $reference;
}

function validSaisieObligatoire(string $cle): string {
    do {
        $testeur = false;
        $champ = recupChamp("Entre un " . $cle . " : ");
        if (!verifChampVide($champ)) {
            $testeur = true;
        } else {
            afficheMessage("Il faut remplir le champ\n");
        }
    } while (!$testeur);
    return $champ;
}

function validSaisiePositif(string $cle): int {
    do {
        $champ = (int) recupChamp("Entre un " . $cle . " : ");
        if ($champ <= 0) {
            afficheMessage("Le " . $cle . " doit être supérieur à 0\n");
        }
    } while ($champ <= 0);
    return $champ;
}


function ajouterProduit(array &$categories, int $indexCategorie, string $reference, string $nom, int $prix, int $quantite): void {
    $categories[$indexCategorie]["produits"][] = [
        "nom"       => $nom,
        "reference" => $reference,
        "prix"      => $prix,
        "quantite"  => $quantite
    ];
}

// 3 -
$code = validSaisieChamp($categories,"code");

$nom = validSaisieChamp($categories,"nom");

$nouvelleCategorie = constructeurDeCategorie($code,$nom,[]);

enregistreCategorie($nouvelleCategorie,$categories);

print_r($categories);


// 4 Ajouter un produit a une categorie
$codePourRecherche = recupChamp("Entre un code pour la recherche : ");
$indexCategorie = rechercheCategorieParCle($categories, "code", $codePourRecherche);

if ($indexCategorie === false) {
    afficheMessage("Le code est introuvable\n");
} else {
    $reference   = validSaisieRef($categories);
    $nomProduit  = validSaisieObligatoire("nom du produit");
    $prixProduit = validSaisiePositif("prix");
    $qteProduit  = validSaisiePositif("quantite");
    ajouterProduit($categories, $indexCategorie, $reference, $nomProduit, $prixProduit, $qteProduit);
    afficheMessage("Produit ajouté avec succès !\n");
    print_r($categories[$indexCategorie]);
}