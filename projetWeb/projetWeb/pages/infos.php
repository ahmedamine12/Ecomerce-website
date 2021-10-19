<?php
require('connexion.php');
$id = $_GET['id'];
$user = $conn->query("SELECT * FROM utilisateurs WHERE id_utilisateur=$id")->fetch();
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
   
    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
</style>

<div class="container">

    <div class="card text-center mt-5">
        <div class="card-header">
            Informations sur cet utilisateur
        </div>
        <div class="card-body">
            <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5>
                                    <?php echo $user['nom_utilisateur']; ?>
                                </h5>
                                <h6>
                                    <?php echo $user['prenom_utilisateur']; ?> </h6>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">A propos :</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="img-thumbnail shadow-lg">
                                <img class="card-img-top" src="../images/clients/<?php echo $user['photo_utilisateur']; ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="mt-5 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>id demande :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['id_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nom et prenom</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['nom_utilisateur']; ?>  <?php echo $user['prenom_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['email_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>téléphone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['numero_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Adresse</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['adresse_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Sexe</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user['sexe_utilisateur']; ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="card-footer text-muted d-flex justify-content-end">
            <a href="envoyerDemande.php?id=<?php print $user['id_utilisateur']; ?>" class="btn btn-success ">Accepter</a>
        </div>
    </div>

</div>


