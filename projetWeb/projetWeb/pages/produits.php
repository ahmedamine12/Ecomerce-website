<?php
require('navbar.php');
require('connexion.php');
?>

<style>
    .imgprod {
        width: 150px;
        height: 150px;
        margin-left: 20%;
        background-size: cover;
    }
</style>

<?php

$id_cat = isset($_GET['id_categorie']) ? $_GET['id_categorie'] : 0;
$search = isset($_GET['search']) ? $_GET['search'] : "";
$size = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * 12;


if ($id_cat != 0) {
    $requetteProduits = "SELECT * 
                        FROM produits,photos 
                        WHERE produits.id_produit = photos.id_produit 
                        AND id_categorie = $id_cat
                        AND nom_produit LIKE '%$search%'
                        GROUP BY produits.id_produit
                        LIMIT 12
                        OFFSET $offset";

    $requeteCount = "SELECT count(*) countS
                     FROM produits
                     WHERE (nom_produit LIKE '%$search%')
                     AND (id_categorie = $id_cat)";
} else {
    $requetteProduits = "SELECT * 
                        FROM produits,photos 
                        WHERE produits.id_produit = photos.id_produit 
                        AND nom_produit 
                        LIKE '%$search%' 
                        GROUP BY produits.id_produit
                        LIMIT 12
                        OFFSET $offset";

    $requeteCount = "SELECT count(*) countS
                    FROM produits
                    WHERE (nom_produit LIKE '%$search%')";
}

$resultatCount = $conn->query($requeteCount)->fetch();
$nbrProduits = $resultatCount['countS'];

$reste = $nbrProduits % $size;
if ($reste === 0) {
    $nbrPage = $nbrProduits / $size;
} else
    $nbrPage = floor($nbrProduits / $size) + 1;

?>
<br><br>
<div class="container px-4 px-lg-5">

    <div class="products row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <?php foreach ($conn->query($requetteProduits) as $row) { ?>
            <div class="product col-md-3 col-sm-6">
                <figure class="card card-product-grid shadow-lg">
                    <?php


                    if ($row['taux_promotion_produit'] != 0) {

                        echo " <div class='badge bg-success text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>" . $row['taux_promotion_produit'] . "%</div>";
                    }
                    ?>
                    <div class="badge bg-transparent  position-absolute" style="top: 8rem; right: 0.5rem">
                        <a href="modifierProduit.php?id_produit=<?php echo $row['id_produit']; ?>" class="link-dark"><i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                    <div>
                        <img class="imgprod" src="../images/produits/<?php print $row['nom_photo'] ?>">
                    </div>
                    <figcaption class="info-wrap border-top text-center">
                        <a href="#" class="fw-bolder ">
                            <?php print $row['nom_produit'] ?>
                        </a>
                        <div class="fw-bolder text-center"> <?php
                                                            $prix = $row['prix_produit'];

                                                            if ($row['taux_promotion_produit'] != 0) {
                                                                $taux = $row['taux_promotion_produit'];
                                                                $newprix = $prix * (1 - ($taux / 100));

                                                                echo " <span><strike>" . $prix .  "</strike> DH</span><br>";
                                                                echo " <span style='color: green;'  >" . $newprix .  " DH</span>";
                                                            } else

                                                                echo " <span>" . $prix .  " DH</span><br>";


                                                            ?> </div>
                    </figcaption>
                    <div class="product card-footer text-center p-4 pt-0 border-top-0 bg-transparent" data-img="<?php print $row['nom_photo'] ?>" data-name="<?php print $row['nom_produit'] ?>" data-price=" <?php print $row['prix_produit'] ?>" data-id=" <?php print $row['id_produit'] ?>">
                        <input type="hidden" class="count" value="1" />
                        <button class="ajouter btn btn-outline-dark mt-auto">Add to cart</button>
                    </div>
                </figure>
            </div>
        <?php } ?>
    </div>
    <div class="row justify-content-center">
        <!-- <div class="container justify-content-center"> -->
            <div class=" mt-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                            <li class="<?php if ($i == $page) echo "page-item active" ?>">
                                <a class="page-link" href="produits.php?page=<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>

                        <?php } ?>
                    </ul>
                </nav>
            <!-- </div> -->
        </div>
    </div>
    <script type="text/template" id="cartT">
        <% _.each(items, function (item) { %> <div class="alert alert-primary" role="alert"> <h5> <%= item.name %> </h5>  <span class="label">
<%= item.count %> piece<% if(item.count > 1)
{%>s
<%}%> à <%= item.total %>DH</span > </div>
<% }); %>
</script>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js'></script>
    <script src="function.js"></script>


    <?php require('footer.php'); ?>