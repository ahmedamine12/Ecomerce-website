<?php
require('connexion.php');

$id_user = $_POST['idUser'];
$login = $_POST['login'];
$password = $_POST['password'];



// $userInfos = "SELECT * FROM utilisateurs WHERE id_utilisateur=$id_user";

$userInfos = $conn->query("SELECT * FROM utilisateurs WHERE id_utilisateur=$id_user")->fetch();

// var_dump($userInfos);

$requetInsertCompte = "INSERT INTO comptes(login,password,type,id_utilisateur) VALUES (?,?,'C',?)";
$resultInsertCompte = $conn->prepare($requetInsertCompte);
$paramInsertCompte = array($login, $password, $id_user);
$resultInsertCompte->execute($paramInsertCompte);

$lastInsertCompte = $conn->lastInsertId();


try {
    echo "last compte " . $lastInsertCompte . " pour user " . $id_user."<br>";

    $requetUpdateUser = "UPDATE utilisateurs SET etat='1',id_compte=$lastInsertCompte WHERE id_utilisateur=$id_user";
    $updateUser = $conn->prepare($requetUpdateUser);
    // $paramUpdateUser = array($lastInsertCompte, $id_user);
    $updateUser->execute();
    echo $updateUser->rowCount() . " records UPDATED successfully";
    header('location:index.html');
} catch (PDOException $e) {
    echo $requetUpdateUser . "<br>" . $e->getMessage();
}
