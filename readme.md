Documentation Projet Sécurité SI

De Suire Evan et Levilloux Antoine


Version de PHP : 8.2
Version de HTML : 5
Version de MySQL : 8.0.31 

Video d'installation : https://drive.google.com/file/d/1ccTeEsG3dlebEvUDYojUNf9mtdXr6FAI/view?usp=share_link
—————————————————————————————————————

Pour le bon fonctionnement du projet, vous devez vous munir d’un ordinateur ayant Wampserver et MySQL 8.0.31

—————————————————————————————————————

Télécharger le projet sur Github et dézipper le.

—————————————————————————————————————

Dans le fichier que vous avez dézipper, merci d’extraire le fichier (bdd.sql).
Ensuite, allez sur phpMyadmin grâce à Wampserver et cliquez sur le bouton, se trouvant en haut au milieu de votre écran, Importer.
Puis choisir le fichier ayant la base de données.
La base de données, authentification, est composée d’une table se nommant users qui contient les tables id, adresse_mail, nom, prenom et mdp.

—————————————————————————————————————

Prenez tous les fichiers restants.
Mettez le à la racine de votre serveur Wamp.
Puis rendez-vous dans le fichier de configuration (/conf/conf_site.php).
Modifier la ligne 11, 12, 13, 14 avec vos informations.

—————————————————————————————————————

Pour vous authentifiez, utiliser les mot de passe admin :
user : admin
mot de passe : changeme
