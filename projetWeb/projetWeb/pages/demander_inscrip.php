<?php

require("connexion.php");
$nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];
$tel=$_POST['tel'];
$date=$_POST['date_naiss'];

$imageTemp=$_FILES['photo']['tmp_name'];
move_uploaded_file($imageTemp,"../images/clients/".$nomPhoto);

$requete="INSERT INTO utilisateurs 
        (nom_utilisateur,prenom_utilisateur,email_utilisateur,adresse_utilisateur,numero_utilisateur,sexe_utilisateur,photo_utilisateur,date_naissance) 
        VALUES(?,?,?,?,?,?,?,?)";

$params=array($nom,$prenom,$email,$adresse,$tel,$sexe,$nomPhoto,$date);

$resultat=$conn->prepare($requete);
$resultat->execute($params);

header('location:demande_reussite.html');