<?php
////////////////////////////////
// Developpeur:Suire          //
// Developpeur:Levilloux      //
////////////////////////////////
$version = "v0.0.1";
////////////////////////
// Database-Config    //
////////////////////////
// || DataBase ||
$db = "authentification";
$dbuser = "";
$dbpass = "";
$ip = "";
///////////////////////
// DataBase PDO      //
///////////////////////



try {
    $bdd = new PDO("mysql:host=$ip;dbname=$db;charset=utf8",$dbuser,$dbpass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Merci de contacter l'administrateur du site web");
}
