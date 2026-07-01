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

$code = validSaisieChamp($categories,"code");
$nom = validSaisieChamp($categories,"nom");


$nouvelleCategorie = constructeurDeCategorie($code,$nom,[]);
enregistreCategorie($nouvelleCategorie,$categories);
print_r($categories);
