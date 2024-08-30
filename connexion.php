<?php

/**
 * Connexion à la BDD
 */

// Localisation de la BDD
const HOST = 'localhost';

// Nom d'utilisateur
const USER = 'root';

// Mot de passe
const PASSWD = 'root';

// Nom de la base de donnée
const DBNAME = 'rooms';

try {
	$db = new PDO("mysql:host=". HOST .";dbname=". DBNAME, USER, PASSWD, [
		// Gestion des erreurs PHP/SQL
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		// Gestion du jeu de caractères
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		// Choix du retour des résultats
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	]);
}
catch (Exception $error) {
	echo 'Erreur lors de la connexion à la base de données : '. $error->getMessage();
}
