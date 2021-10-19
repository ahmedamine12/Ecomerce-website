<?php
require_once"connexion.php";
if(!empty($_GET))

$id=$_GET['id'];
$sql="DELETE FROM photos WHERE id_produit='$id';

-- DELETE FROM `produits`WHERE id_produit='$id' " ;
 $query=$conn->prepare($sql);
 $query->execute();
 header('Location: produits.php');

 ?>