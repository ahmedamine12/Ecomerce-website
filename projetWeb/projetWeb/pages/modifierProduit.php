<?php
// session_start();
header('content-type: text/html; charset=utf-8');

require('navbar.php');



require('connexion.php');


$id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : 0;

$detailsProduit = "SELECT id_produit, nom_produit, description_produit, prix_produit,taux_promotion_produit, quantite_produit,nom_categorie, nom_marque, nom_modele 
                    FROM produits as p, categories as c, modeles as m, marques as q 
                    WHERE p.id_produit=$id_produit 
                    AND p.id_modele=m.id_modele 
                    AND p.id_categorie=c.id_categorie 
                    AND m.id_marque=q.id_marque";

$resultatdetailsProduit = $conn->query($detailsProduit)->fetch();
// var_dump($resultatdetailsProduit);

$photosProduit = "SELECT * FROM photos WHERE photos.id_produit=$id_produit";
$resultatPhotoProduit = $conn->query($photosProduit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails produit</title>
</head>

<style>
    .imgprod {
        width: 550px;
        height: 550px;
        background-size: cover;
    }
</style>

<body>

    <?php if ($_SESSION['client']['type'] == 'A') {  ?>
        <div class="d-flex justify-content-center">
            <div class="center col-2 bg-light border mt-5 ml-5">
                <a class="btn btn-danger mx-3" href="DELETE.php?id=<?php echo $resultatdetailsProduit['id_produit']; ?>" onclick="return confirm('Etes vous sure de vouloir supprimer ce produit ?')">Supprimer </a>
                <a class="btn btn-success my-3" href="update.php?id=<?php echo $resultatdetailsProduit['id_produit']; ?>">Modifier</a>
            </div>
        </div>
    <?php } ?>


    <section>
        <div class="container bg-light p-5 border mt-5">
            <div class="row align-items-center ">
                <!-- debut carousel -->
                <div id="carouselExampleIndicators" class=" border col-6 carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $i = 0;
                        while ($photo = $resultatPhotoProduit->fetch()) {
                        ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php print $i; ?>" <?php echo $i == 0 ? 'class="active"' : '' ?>></li>
                        <?php
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">


                        <?php $j = 0;
                        foreach ($conn->query($photosProduit) as $rowPhoto) { ?>
                            <div class="carousel-item  <?php if ($j == "0") {
                                                            echo 'active';
                                                        } ?>">
                                <img class="imgprod " src="../images/produits/<?php print $rowPhoto['nom_photo']; ?>">
                            </div>
                        <?php
                            $j++;
                        } ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- fin carousel -->
                <div class="col-md-6">
                    <div class="small mb-1">ID : <?php print $resultatdetailsProduit['id_produit']; ?></div>
                    <h1 class="display-5 fw-bolder"><?php print $resultatdetailsProduit['nom_produit']; ?></h1>
                    <div class="fs-5 mb-5 text-success font-weight-bolder">
                        <?php
                        $prix = $resultatdetailsProduit['prix_produit'];

                        if ($resultatdetailsProduit['taux_promotion_produit'] != 0) {
                            $taux = $resultatdetailsProduit['taux_promotion_produit'];
                            $newprix = $prix * (1 - ($taux / 100));
                            echo " <span><strike>" . $prix .  "</strike>DH</span><br>";
                            echo " <span>" . $newprix .  "DH</span>";
                        } else
                            echo " <span>" . $prix .  "DH</span><br>";
                        ?>

                    </div>
                    <p class="lead"><?php print nl2br($resultatdetailsProduit['description_produit']); ?></p>
                    <div class="d-flex">
                        <div class="badge badge-primary text-wrap mr-3" style="width: 6rem;">
                            <?php echo $resultatdetailsProduit['nom_categorie'] ?>
                        </div>
                        <div class="badge badge-primary text-wrap mr-3" style="width: 6rem;">
                            <?php echo $resultatdetailsProduit['nom_modele'] ?>
                        </div>
                        <div class="badge badge-primary text-wrap mr-3" style="width: 6rem;">
                            <?php echo $resultatdetailsProduit['nom_marque'] ?>
                        </div>
                        <div class="badge badge-primary text-wrap mr-3" style="width: 6rem;">
                            <?php echo $resultatdetailsProduit['quantite_produit'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<footer>
    <?php require('footer.php'); ?>
</footer>

</html>