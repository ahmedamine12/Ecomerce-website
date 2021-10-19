<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifiction</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <?php
    require_once "connexion.php";
    $id_produit = isset($_GET['id']) ? $_GET['id'] : 0;

    $detailsProduit = "SELECT * FROM produits,modeles WHERE id_produit=$id_produit AND produits.id_modele=modeles.id_modele";
    $resultatdetailsProduit = $conn->query($detailsProduit)->fetch();

    $photosProduit = "SELECT * FROM photos WHERE photos.id_produit=$id_produit";
    $resultatPhotoProduit = $conn->query($photosProduit);


    ?>
    <div class="container panel panel-primary margetop shadow pb-5">
        <div class="mt-5 panel-heading">
            <h1>Modification ... <i class="bi bi-pencil-fill"></i></h1>
            <div class="panel-body bg-light p-3 pt-5 mt-3 border">

                <form method="post" action="modifier_produit.php" enctype="multipart/form-data">

                    <div class="row mb-5">

                        <input type="hidden" name="idP" value="<?php echo $id_produit; ?>" />
                        <div class="col-6">
                            <label for="nom" class="form-label">Désignation :</label>
                            <input type="text" class="form-control" name="nom" value="<?php echo $resultatdetailsProduit['nom_produit']; ?>">
                        </div>

                        <div class="col-6">
                            <label for="description" class="form-label">Description :</label>
                            <!-- <input type="text"  name="description" ><br> -->
                            <textarea id="description" name="description" rows="5" class="form-control" value=""><?php echo $resultatdetailsProduit['description_produit']; ?></textarea>

                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-4">
                            <label for="category_name" class="form-label">Categorie :</label>
                            <select class="form-select col-12" id="category_name" name="category_name">
                                <?php
                                $categorie = "SELECT * from categories";

                                $requet = $conn->query($categorie);
                                $marques = $requet->fetchAll();
                                foreach ($marques as $marque) {
                                ?>
                                    <option value="<?php echo $marque['id_categorie']  ?>" <?php if ($resultatdetailsProduit['id_categorie'] === $marque['id_categorie']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                        <?php echo $marque['nom_categorie']  ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="marque" class="form-label">Marque :</label>
                            <select class="form-select col-12" id="marque" name="marque">
                                <?php
                                $marque = "SELECT * from marques";

                                $requet = $conn->query($marque);
                                $marques = $requet->fetchAll();
                                foreach ($marques as $marque) {
                                ?>
                                    <option value="<?php echo $marque['id_marque']  ?>" <?php if ($resultatdetailsProduit['id_marque'] === $marque['id_marque']) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                        <?php echo $marque['nom_marque']  ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-4">
                            <label for="modele" class="form-label ">Modele :</label>
                            <select class="form-select col-12" id="modele" name="modele">
                                <?php
                                $idMarque = $resultatdetailsProduit['id_marque'];
                                $modele = "SELECT * from modeles WHERE id_marque = $idMarque";

                                $requet = $conn->query($modele);
                                $modeles = $requet->fetchAll();
                                foreach ($modeles as $modele) {
                                ?>
                                    <option value="<?php echo $modele['id_modele']  ?>" <?php if ($resultatdetailsProduit['id_modele'] === $modele['id_modele']) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                        <?php echo $modele['nom_modele']  ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>



                    <div class="row mb-5">
                        <div class="col-2"></div>

                        <div class="col-3">
                            <label for="model" class="form-label"> Quantite :</label>
                            <input type="number" class="form-control" name="quantite" value="<?php echo $resultatdetailsProduit['quantite_produit']; ?>"><br>
                        </div>
                        <div class="col-2"></div>

                        <div class="col-3">
                            <label for="promotion" class="form-label"> Taux promotion :</label>
                            <input type="text" name="promotion" class="form-control" value="<?php echo $resultatdetailsProduit['taux_promotion_produit']; ?>"><br>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-2"></div>
                        <div class="col-3"> <label for="prix" class="form-label"> Prix :</label>
                            <div class="input-group  ">
                                <input type="text" class="form-control" name="prix" value="<?php echo $resultatdetailsProduit['prix_produit']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">DH</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-end">
                        <button class="btn btn-success" type="submit"> Enregistrer </button>
                    </div>
                </form>
            </div>
</body>




</html>