<?php
/*
 * Front Controller de la gestion du livre d'or
 */

/*
 * Chargement des dépendances
 */
// chargement de configuration
require_once "../config.php";
// chargement du modèle de la table livreor
require_once "../model/livreorModel.php";
require_once "../model/PaginationModel.php";
/*
 * Connexion à la base de données en utilisant PDO
 * Avec un try catch pour gérer les erreurs de connexion
 */

 try {
    $db = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=" . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

/*
 * Si le formulaire a été soumis
 */
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'])) {
    // on appelle la fonction d'insertion dans la DB (addLivreOr())
    $insert = addLivreOr($db, $_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message']);
    // si l'insertion a réussi
    if ($insert) {
    // on redirige vers la page actuelle
    $message = "Insertion réussi";
    // sinon, on affiche un message d'erreur
    } else {
    $message = "Erreur lors de l'insertion";
    }
}


if(!empty($_GET[PAGE_VAR_GET]) && ctype_digit($_GET[PAGE_VAR_GET])){
    $page = (int) $_GET[PAGE_VAR_GET];
}else{
    $page = 1;
}


$nbComments = countComments($db) ;

$pagination = PaginationModel("./",PAGE_VAR_GET,$nbComments,$page,PAGE_BY_PG);

// on récupère les commentaires par page
$informations = getPaginationComments($db,$page,PAGE_BY_PG);

/*  
 * On récupère les messages du livre d'or
 */

// on appelle la fonction de récupération de la DB (getAllLivreOr())
//$informations = getAllLivreOr($db);
// fermeture de la connexion
$db = null;
// Appel de la vue

include "../view/livreorView.php";