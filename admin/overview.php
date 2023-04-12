<?php
session_start();
require("../conf/conf_site.php");
require('../modules/verif_login.php');
$erreur = '';
if ($_SESSION["permission"] != 1) {

  header("location:../login.php");
}
$articleslist = $bdd->query('SELECT * FROM articles');
$articles = $articleslist->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["edit"])) {
  $id_post = $_GET["edit"];
  if (!empty($_POST['editor']) && !empty($_FILES['image'])) {
    $content = $_POST['editor'];
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (in_array($file_extension, $allowed_types)) {
      $upload_dir = '../public/img/';
      $filename = uniqid() . '.' . $file_extension;
      $upload_path = $upload_dir . $filename;
      if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        $article = $bdd->prepare("UPDATE articles SET contenu = ?, img = ? WHERE id = ?");
        $article->execute(array($content, $filename, $id_post));
        header("Location: ../public/blog.php");
      } else {
        $erreur =  'Une erreur est survenue lors de l\'upload du fichier.';
      }
    } else {
      $erreur =  'Le fichier doit être une image (jpg, jpeg, png ou gif).';
    }
  }
} else {
  if (!empty($_POST['editor']) && !empty($_FILES['image'])) {
    $content = $_POST['editor'];
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (in_array($file_extension, $allowed_types)) {
      $upload_dir = '../public/img/';
      $filename = uniqid() . '.' . $file_extension;
      $upload_path = $upload_dir . $filename;
      if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        $article = $bdd->prepare("INSERT INTO articles(contenue,img) VALUES (?, ?)");
        $article->execute(array($content, $filename));
        header("Location: ../public/blog.php");
      } else {
        $erreur =  'Une erreur est survenue lors de l\'upload du fichier.';
      }
    } else {
      $erreur =  'Le fichier doit être une image (jpg, jpeg, png ou gif).';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin Page</title>
  <link rel="stylesheet" href="../asset/css/main.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
</head>

<body>
  <ul class="navbar">
    <li><a href="../public/blog.php">Blog.com</a></li>
    <li style="float:right"><a class="active" href="../logout.php">Se déconnecter</a></li>
  </ul>


  <h2 style="text-align: center;">Ajouter un article</h2>
  <?= $erreur ?>
  <div class="container-overview">
    <form method="POST" enctype="multipart/form-data">
      <textarea name="editor" id="editor">

<?php
if (isset($_GET["edit"])) {
  $id_blog = $_GET["edit"];
  $edit = $bdd->prepare("SELECT * FROM articles WHERE `id` = ?");
  $edit->execute(array($id_blog));
  $article_edit = $edit->fetch();
  echo $article_edit["contenue"];
}
?>

      </textarea>
      <input type="file" name="image" placeholder="Image">
      <button type="submit">Enregistrer</button>
    </form>
  </div>


  <h2 style="text-align: center;">Vos articles</h2>
  <?php foreach ($articles as $article) : ?>
    <div class="container-blog">
      <?php echo $article['contenue']; ?>
      <img style="max-width: 500px;" src="../public/img/<?= $article['img'] ?>" alt="<?= $article['contenue'] ?>">
      <hr>
      <a href="../admin/overview.php?edit=<?= $article['id'] ?>">Editer</a>
      <a href="../modules/edit.php?rm=<?= $article['id'] ?>">Supprimer</a>
    </div>
  <?php endforeach; ?>
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>
</body>

</html>