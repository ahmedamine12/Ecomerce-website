<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <h3>Inscription</h3>
    <form action="demander_inscrip.php" method="POST" enctype="multipart/form-data" >
        <label>Photo : </label>
        <input type="file" name="photo" /><br>
        <label>Nom : </label>
        <input type="text" name="nom"/><br>
        <label>Prenom : </label>
        <input type="text" name="prenom"/><br>           
        <div>
            <label>Sexe</label>
            <ol>
                <li><input type="radio" name="sexe" value="F"/>Femme</li>
                <li><input type="radio" name="sexe" value="M"/>Homme</li>
            </ol>
        </div>
        <label>Email : </label>
        <input type="mail" name="email" /><br>
        <label>Adresse : </label>
        <input type="text" name="adresse" /><br>
        <label>Téléphone : </label>
        <input type="text" name="tel" /><br>
        <label>Date de naissance : </label>
        <input type="date" name="date_naiss"/><br>

        <input type="submit" value="done">
    </form>
</body>

</html>