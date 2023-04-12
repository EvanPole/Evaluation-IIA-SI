
CREATE DATABASE IF NOT EXISTS `authentification`;
USE `authentification`;

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenue` text NOT NULL,
  `date_cree` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adresse_mail` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nom` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `prenom` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `derniere_connexion` date DEFAULT NULL,
  `permission` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `adresse_mail` (`adresse_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

