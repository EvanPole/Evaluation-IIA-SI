<?php
session_start();
require("../conf/conf_site.php");

$articleslist = $bdd->query('SELECT * FROM articles');
$articles = $articleslist->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/css/main.css">
</head>

<body>
    <ul class="navbar">
        <li><a href="#home">Blog.com</a></li>
        <?php
        if (isset($_SESSION["permission"])) {
            if ($_SESSION["permission"] == 1) {
                echo '<li style="float:right"><a class="active" href="../admin/overview.php">Admin Page</a></li>';
            }
            echo '<li style="float:right"><a class="active" href="../logout.php">Déconnexion</a></li>';
        } else {

            echo '<li style="float:right"><a class="active" href="../login.php">Login</a></li>';
        }

        ?>

    </ul>



    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Tous les articles</title>
    </head>

    <body>
        <h1 style="text-align: center;">Tous les articles</h1>
        <?php foreach ($articles as $article) : ?>
            <div class="container-blog">
                <?php echo $article['contenue']; ?>
                <img style="max-width: 500px;" src="img/<?= $article['img'] ?>" alt="<?= $article['contenue'] ?>">
            </div>
        <?php endforeach;
        if(count($articles) == 0){
            echo'<p style="text-align: center;">Vous pouvez ajouter des des articles sur le <a href="../admin/overview.php">panel administrateur<a/></p>';
        }
        ?>
        
    </body>

    </html>

</body>

</html>