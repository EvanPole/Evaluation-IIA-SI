<?php
session_start();
require("./conf/conf_site.php");
$erreur = '';
if(empty($_SESSION['tentative'])){
    $_SESSION['tentative'] = 0;
}
$_SESSION['tentative'] += 1;

if ($_SESSION['tentative'] <= 15) {
        if (isset($_POST["mail"]) && isset($_POST["mdp"])) {
            $mail = $_POST["mail"];
            $mdp = $_POST["mdp"];
            $mdp = hash('sha256', $mdp);
            $info_login = $bdd->prepare("SELECT * FROM users WHERE adresse_mail = ?");
            $info_login->execute(array($mail));
            if ($info_login->rowCount() > 0) {
                $user_info = $info_login->fetch();
                if ($mdp == $user_info["mdp"]) {
                    $_SESSION["id"] = $user_info["id"];
                    $_SESSION["adresse_mail"] = $user_info["adresse_mail"];
                    $_SESSION["nom"] = $user_info["nom"];
                    $_SESSION["prenom"] = $user_info["prenom"];
                    $_SESSION["permission"] = $user_info["permission"];
                    $info_co = $bdd->prepare("UPDATE users SET derniere_connexion = ? WHERE adresse_mail = ?");
                    $date = date('Y-m-d H:i:s');
                    $info_co->execute(array($date, $mail));

                    header("Location: ./admin/overview.php");
                } else {
                    $erreur = "Le mdp ne correspond pas !";
                }
            } else {
                $erreur = "L'utilisateur n'existe pas";
            }
        } else {
            $erreur = "Merci de remplire tous les champs";
        }
    } else {
        $erreur = "Trop de tentatives";
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
</head>

<body>
    <div class="main-container">
        <form method="post">
            <h2>Login</h2>
            <input type="text" placeholder="mail" name="mail">
            <input type="password" placeholder="Mot de passe" name="mdp">
            <button type="submit">Continuer</button>
            <p style="color: red;"><?= $erreur ?></p>
        </form>
        <a href="public/blog.php">Retour au blog</a>
        <a href="register.php">Inscription</a>
    </div>
</body>

</html>