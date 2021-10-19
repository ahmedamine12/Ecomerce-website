<?php

require('connexion.php');

$reqCommandes = "SELECT cmd.id_commande,
                cmd.date_commande,
                user.prenom_utilisateur,
                user.nom_utilisateur,
                l.type_livraison,
                e.nom_etat,
                cmd.type_paiement,
                user.adresse_utilisateur,
                SUM(lc.prix*lc.qte) as total
                FROM commandes as cmd, lignes_comandes as lc, utilisateurs as user, etats as e, livraisons as l
                WHERE cmd.id_commande = lc.id_cmd AND cmd.id_utilisateur = user.id_utilisateur AND cmd.id_etat = e.id_etat and cmd.id_livraison = l.id_livraison
                GROUP BY lc.id_cmd";

include('navbar.php');
?>


<div class="container">
    <div class="card text-white bg-primary mt-3">
        <div class="card-header"> Liste des commandes </div>
       </div>
       <div class="bg-light">
            <table class="table table-striped ">
                <tr>
                    <th>N</th>
                    <th>date</th>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>livraison</th>
                    <th>etat</th>
                    <th>paiement</th>
                    <th>total</th>
                </tr>
                <?php
                foreach ($conn->query($reqCommandes) as $commande) { ?>

                    <tr>
                        <td><?php print $commande['id_commande'] ?></td>
                        <td><?php print $commande['date_commande'] ?></td>
                        <td><?php print $commande['prenom_utilisateur'] ?></td>
                        <td><?php print $commande['nom_utilisateur'] ?></td>
                        <td><?php print $commande['type_livraison'] ?></td>
                        <td><?php print $commande['nom_etat'] ?></td>
                        <td><?php print $commande['type_paiement'] ?></td>
                        <td><?php print $commande['total'] ?></td>
                    </tr>
                    <br>
                <?php } ?>
            </table></div>
        </div>
    </div>
</div>
</div>