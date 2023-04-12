<?php
session_start();
require("./conf/conf_site.php");
$erreur = '';

if (!empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["f-name"]) && !empty($_POST["mail"])) {

    $response = $_POST['h-captcha-response'];
    $verify = file_get_contents("https://hcaptcha.com/siteverify?secret=VOTRE_SECRETKEY&response={$response}");
    $captcha_success = json_decode($verify);
    if ($captcha_success->success == false || $captcha_active == true) {
        $erreur = 'Captcha invalide !';
    } else {

        $name = $_POST["name"];
        $fname = $_POST["f-name"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $mail = $_POST["mail"];

        if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#\W+#", $password)) {
            $erreur = 'Le mot de passe doit contenir au moins 8 caractères dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.';
        } else {
            if ($password == $password2) {
                $password = hash('sha256', $_POST["password"]);
                $info_users = $bdd->prepare("SELECT * FROM users WHERE adresse_mail = ?");
                $info_users->execute(array($mail));
                if ($info_users->rowCount() == 0) {
                    $register = $bdd->prepare("INSERT INTO users(adresse_mail,nom,prenom,mdp) VALUE(?,?,?,?)");
                    $register->execute(array($mail, $name, $fname, $password));
                    header("location:login.php");
                } else {
                    $erreur = 'L\'utilisateur existe déjà !';
                }
            } else {
                $erreur = 'Le mot de passe ne correspond pas !';
            }
        }
    }
} else {
    $erreur = 'Merci de remplir tous les champs';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./asset/css/main.css">
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>

<body>
    <form method="post">
        <div class="main-container">
            <h2>Inscription</h2>
            <input type="text" placeholder="Nom" name="name" value="<?php if(isset($_POST["mail"])){echo$_POST["name"];}?>">
            <input type="text" placeholder="Prénom" name="f-name" value="<?php if(isset($_POST["mail"])){echo$_POST["f-name"];}?>">
            <input type="email" placeholder="Mail" name="mail" value="<?php if(isset($_POST["mail"])){echo$_POST["mail"];}?>">
            <input type="password" placeholder="Mot de passe" name="password">
            <input type="password" placeholder="Confirmation mot de passe" name="password2">
            <?php if($captcha_active == true){?>
            <div class="h-captcha" data-sitekey="<?=$captcha?>"></div>
            <?php }?>
            <button type="submit">Envoyer</button>
            <p style="color: red;"><?= $erreur ?></p>
            <a href="login.php">Login</a>
        </div>
    </form>
</body>

</html>