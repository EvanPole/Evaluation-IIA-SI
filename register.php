<?php
session_start();
require("./conf/conf_site.php");
$erreur = '';

    if (!empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["f-name"]) && !empty($_POST["mail"])) {
        $name = $_POST["name"];
        $fname = $_POST["f-name"];
        $password = $_POST["password"];
        $mail = $_POST["mail"];
        $password = hash('sha256', $_POST["password"]);

        $info_users = $bdd->prepare("SELECT * FROM users WHERE adresse_mail = ?");
        $info_users->execute(array($mail));
        if ($info_users->rowCount() == 0) {
            $register = $bdd->prepare("INSERT INTO users(adresse_mail,nom,prenom,mdp,`permission`) VALUE(?,?,?,?,1)");
            $register->execute(array($mail, $name, $fname, $password));
        } else {
            $erreur = 'L\'utilisateur existe déjà !';
        }
    } else {
        $erreur = 'Merci de remplir tous les champs.';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./asset/css/main.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <form method="post">
        <div class="main-container">
            <h2>Inscription</h2>
            <input type="text" placeholder="Nom" name="name">
            <input type="text" placeholder="Prénom" name="f-name">
            <input type="mail" placeholder="Mail" name="mail">
            <input type="password" placeholder="Mot de passe" name="password">
            <button type="submit">Envoyer</button>
            <p style="color: red;"><?= $erreur ?></p>
            <a href="login.php">Login</a>
        </div>
    </form>
</body>

</html>