<?php
session_start();
require('../conf/conf_site.php');
require('verif_login.php');

if(isset($_GET['rm']) && $_SESSION['permission'] == 1){
    $id_blog = $_GET['rm'];
    $del_blog = $bdd->prepare("DELETE FROM articles WHERE `id` = ?");
    $del_blog->execute(array($id_blog));
    header("Location: ../admin/overview.php");
}

