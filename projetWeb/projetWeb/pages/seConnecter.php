<?php
session_start();

require('connexion.php');

$login = $_POST['login'];
$password = $_POST['password'];


$reqSelectUser = "SELECT * FROM comptes,utilisateurs WHERE email_utilisateur='$login' AND password='$password' AND comptes.id_compte=utilisateurs.id_compte";

$resultat=$conn->query($reqSelectUser);



if($user=$resultat->fetch()){
    $_SESSION["client"]=[

        "pass"=>$user["password"],
        "id"=> $user["id_utilisateur"],
        "nom"=>$user["nom_utilisateur"],
        "prenom"=>$user["prenom_utilisateur"], 
        "email"=>$user["email_utilisateur"],
        "photo"=>$user["photo_utilisateur"], 
        "type"=>$user["type"]

    ];
    var_dump($_SESSION['client']);
        header("location:produits.php");
}else{
	header("location:index.html");
}
