<?php

require('connexion.php');

$reqDemandes = "SELECT * FROM utilisateurs WHERE etat='0'";

include('navbar.php');
?>


<div class="container">
    <div class="card text-white bg-primary mt-3">
        <div class="card-header"> Liste des demandes </div>
       </div>
       <div class="bg-light">
            <table class="table table-striped ">
                <tr>
                    <th>photo</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>email</th>
                    <th>adresse</th>
                    <th>numero</th>
                    <th>sexe</th>
                    <th>date naissance</th>
                    <th>infos</th>
                </tr>
                <?php
                foreach ($conn->query($reqDemandes) as $demande) { ?>

                    <tr>
                        <td><img src=" ../images/clients/<?php print $demande['photo_utilisateur'] ?>" width="30px" height="30px" class="img-circle" /> </td>
                        <td><?php print $demande['nom_utilisateur'] ?></td>
                        <td><?php print $demande['prenom_utilisateur'] ?></td>
                        <td><?php print $demande['email_utilisateur'] ?></td>
                        <td><?php print $demande['adresse_utilisateur'] ?></td>
                        <td><?php print $demande['numero_utilisateur'] ?></td>
                        <td><?php print $demande['sexe_utilisateur'] ?></td>
                        <td><?php print $demande['date_naissance'] ?></td>
                        <td><a href="infos.php?id=<?php print $demande['id_utilisateur'] ?>" />infos</td>
                    </tr>
                    <br>
                <?php } ?>
            </table></div>
        </div>
    </div>
</div>
</div>