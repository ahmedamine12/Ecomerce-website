<?php
require('connexion.php');

if (!empty($_POST)) {
    $id_produit = $_POST["idP"];
    $nom = strip_tags($_POST["nom"]);
    $description = addslashes($_POST['description']);
    $categorie = $_POST["category_name"];
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $prix = $_POST["prix"];
    $quantite = $_POST["quantite"];
    $promotion = $_POST["promotion"];

var_dump($_POST);
  $sql = "UPDATE  produits set nom_produit='$nom', description_produit='$description',
            prix_produit='$prix',taux_promotion_produit='$promotion',
            quantite_produit ='$quantite', 
            id_categorie = '$categorie',
            id_modele ='$modele' 
            where  id_produit ='$id_produit'";

    $query = $conn->prepare($sql);
    $query->execute();
    header('Location: produits.php');
}



?>