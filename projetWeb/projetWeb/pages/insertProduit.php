<?php
require_once  "connexion.php";

$erreurs = array();
$success = array();

$nom = isset($_POST['nom'])?$_POST['nom']:"";
$description = isset($_POST['description'])?$_POST['description']:"";
$prix = isset($_POST['prix'])?$_POST['prix']:"";
$modele = isset($_POST['modele'])?$_POST['modele']:"";
$categorie = isset($_POST['categorie'])?$_POST['categorie']:"";
$marque = isset($_POST['marque'])?$_POST['marque']:"";


if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

    $repertoireCible = '../images/produits/';
    $typesPermis = array('jpg','png','jpeg','gif');

    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            $extensionFichier = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
            if(in_array(strtolower($extensionFichier),$typesPermis))
            {  
                $nomFichier = basename($_FILES['files']['name'][$key]);
                $cheminFichier = $repertoireCible.$nomFichier;
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $cheminFichier)){
                    $success[] = "Uploaded $nomFichier";
                    $nomsDesFichiers[] = "$nomFichier";
                }
                else {
                    $erreurs[] = "quelque chose qui ne va pas - File - $nomFichier";
                }
            }
        }

        //Inserting to database
        if(!empty($nomsDesFichiers)) {
            
            $sql2 = "INSERT INTO produits (nom_produit, description_produit, prix_produit, id_modele, id_categorie) VALUES (?,?,?,?,?)";
            $stmt2= $conn->prepare($sql2);
            $data = array($nom, $description, $prix, $modele, $categorie);
            var_dump($data);
            $stmt2->execute($data);

            
            $lastId = $conn->lastInsertId();

            foreach ($nomsDesFichiers as $nomfich) {
                $nomsDesFichiersavecid[] = "('$nomfich',$lastId)";
            }

            $query = implode(",",$nomsDesFichiersavecid);
            var_dump($query);
            $sql = "INSERT INTO photos (nom_photo, id_produit) VALUES $query";
            $stmt= $conn->prepare($sql);
            $stmt->execute();
        }
    }
    else {
        $erreurs[] = "<br><br>aucun fichier n'a été choisis";
        echo $erreurs['0'];
    }

}

 header('location:remplire_produits.php');

?>