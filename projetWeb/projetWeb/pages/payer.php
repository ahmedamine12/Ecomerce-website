<?php
session_start();
require('connexion.php');
$idUser = $_SESSION['client']['id'];

// if (isset($_POST['prods'])) {


$prods = json_decode($_POST['prods']);

var_dump($_POST['prods']);
var_dump($_POST['type']);
var_dump($_POST['infos']);
var_dump($_POST['livraison']);


switch ($_POST['type']) {
    case 'c':
        $num_cb = $_POST['infos']['1'];
        $nom_poprio = $_POST['infos']['0'];
        $livraison = $_POST['livraison'];

        $requete = "INSERT INTO commandes (id_utilisateur,id_livraison,id_etat,type_paiement) VALUES ($idUser,$livraison,'1','carte bleu')";
        $insertCommande = $conn->prepare($requete);
        $insertCommande->execute();
        var_dump($insertCommande);
        $lastCommande = $conn->lastInsertId();
        foreach ($prods as $prod) {
            $requete = "INSERT INTO lignes_comandes (nom,prix,id_produit,qte,id_cmd) VALUES ('$prod->name','$prod->price','$prod->id','$prod->count',$lastCommande)";
            $insertLigne = $conn->prepare($requete);
            $insertLigne->execute();
            $id_prod = $prod->id;
            echo "id" . $id_prod;

            $recupQte = "SELECT quantite_produit FROM produits WHERE id_produit = $id_prod";
            $recuperer = $conn->prepare($recupQte);
            $recuperer->execute();
            $ancienneQte = $recuperer->fetch();
            $nvQte = $ancienneQte['quantite_produit'] - $prod->count;

            $updateQte = "UPDATE produits SET quantite_produit = $nvQte WHERE produits.id_produit = $id_prod";
            var_dump($updateQte);
            $update = $conn->prepare($updateQte);
            $update->execute();

            var_dump($insertLigne);
        }
        $requete = "INSERT INTO carte_banquaires (numero_carte_banquaire,Nom_prop_carte_banquaire,id_commande) VALUES (?,?,?)";
        $insertCB = $conn->prepare($requete);
        $insertCB->execute([$num_cb, $nom_poprio, $lastCommande]);
        var_dump($insertCommande);
        header('location:produits.php');
        break;



    case 'q':
        $date_encaiss = $_POST['infos']['0'];
        $montant = $_POST['infos']['1'];
        $banque = $_POST['infos']['2'];
        $livraison = $_POST['livraison'];

        $requete = "INSERT INTO commandes (id_utilisateur,id_livraison,id_etat,type_paiement) VALUES ($idUser,$livraison,'2','chèque')";
        $insertCommande = $conn->prepare($requete);
        $insertCommande->execute();
        var_dump($insertCommande);
        $lastCommande = $conn->lastInsertId();
        foreach ($prods as $prod) {
            $requete = "INSERT INTO lignes_comandes (nom,prix,id_produit,qte,id_cmd) VALUES ('$prod->name','$prod->price','$prod->id','$prod->count',$lastCommande)";
            $insertLigne = $conn->prepare($requete);
            $insertLigne->execute();
            $id_prod = $prod->id;
            echo "id" . $id_prod;

            $recupQte = "SELECT quantite_produit FROM produits WHERE id_produit = $id_prod";
            $recuperer = $conn->prepare($recupQte);
            $recuperer->execute();
            $ancienneQte = $recuperer->fetch();
            $nvQte = $ancienneQte['quantite_produit'] - $prod->count;

            $updateQte = "UPDATE produits SET quantite_produit = $nvQte WHERE produits.id_produit = $id_prod";
            var_dump($updateQte);
            $update = $conn->prepare($updateQte);
            $update->execute();

            var_dump($insertLigne);
        }
        $requete = "INSERT INTO cheques (montant_cheque,date_encaissement,id_banque,id_commande) VALUES (?,?,?,?)";
        $insertCheque = $conn->prepare($requete);
        $insertCheque->execute([$montant, $date_encaiss, $banque, $lastCommande]);
        var_dump($insertCheque);
        header('location:produits.php');
        break;

    case 'e':
        $montant = $_POST['infos']['0'];

        $livraison = $_POST['livraison'];

        $requete = "INSERT INTO commandes (id_utilisateur,id_livraison,id_etat,type_paiement) VALUES ($idUser,$livraison,'1','espèce')";
        $insertCommande = $conn->prepare($requete);
        $insertCommande->execute();
        var_dump($insertCommande);
        $lastCommande = $conn->lastInsertId();
        foreach ($prods as $prod) {
            $requete = "INSERT INTO lignes_comandes (nom,prix,id_produit,qte,id_cmd) VALUES ('$prod->name','$prod->price','$prod->id','$prod->count',$lastCommande)";
            $insertLigne = $conn->prepare($requete);
            $insertLigne->execute();
            $id_prod = $prod->id;
            echo "id" . $id_prod;

            $recupQte = "SELECT quantite_produit FROM produits WHERE id_produit = $id_prod";
            $recuperer = $conn->prepare($recupQte);
            $recuperer->execute();
            $ancienneQte = $recuperer->fetch();
            $nvQte = $ancienneQte['quantite_produit'] - $prod->count;

            $updateQte = "UPDATE produits SET quantite_produit = $nvQte WHERE produits.id_produit = $id_prod";
            var_dump($updateQte);
            $update = $conn->prepare($updateQte);
            $update->execute();

            var_dump($insertLigne);
        }
        $requete = "INSERT INTO especes (montant_espece,id_commande) VALUES (?,?)";
        $insertEspece = $conn->prepare($requete);
        $insertEspece->execute([$montant, $lastCommande]);
        var_dump($insertEspece);
        header('location:produits.php');
        break;

    default:
        # code...
        break;
}


function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_decode($data) . ')';
    echo '</script>';
}
