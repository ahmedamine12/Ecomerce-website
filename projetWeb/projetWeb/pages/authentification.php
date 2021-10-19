<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authentification</title>
</head>

<body>

<h1>Page d'authentification </h1>
    <form action="seConnecter.php" method="POST" enctype="multipart/form-data">
        <div>
            <label>login</label>
            <input type="text" name="login" />
        </div>
        <div>
            <label>password</label>
            <input type="password" name="password" />
        </div>
        <input type="submit">
    </form>
    <a href="inscription.php">inscription</a>
    </body>

</html>