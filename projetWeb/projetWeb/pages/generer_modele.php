<?php
$q = intval($_GET['q']);
require('connexion.php');
$requetModele = "SELECT * FROM modeles WHERE id_marque='" . $q . "'";
?>
<label for="modele">modéle : </label>
<select name="modele" class="form-control col-5">
    <?php foreach ($conn->query($requetModele) as $row) { ?>
        <option value="<?php echo $row['id_modele'] ?>"><?php echo $row['nom_modele'] ?></option>
    <?php } ?>
</select>