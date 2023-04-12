<?php
////////////////////////////////
// Developpeur:Suire          //
// Developpeur:Levilloux      //
////////////////////////////////
$version = "v0.0.1";
$captcha = "secret_key";
////////////////////////
// Database-Config    //
////////////////////////
// || DataBase ||
$db = "authentification";
$dbuser = "";
$dbpass = "";
$ip = "127.0.0.1";
///////////////////////
// DataBase PDO      //
///////////////////////



try {
    $bdd = new PDO("mysql:host=$ip;dbname=$db;charset=utf8",$dbuser,$dbpass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Merci de contacter l'administrateur du site web");
}
