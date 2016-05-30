<?php

// méthode chdir = techniquement dans CMSG2
// retour de tout ça dans $rootDir
// dirname contient le répertoire au-dessus de /admin
// __DIR__ contient /admin
chdir($rootDir = dirname(__DIR__));

require_once "init.php";
$page = new \Controller\PageController($pdo);

$action = '';
if(isset($_GET['a'])) {
    $action = $_GET['a'];
}

// équivalent du if mais php 7
// âction = $_GET['a'] ?? '';

switch($action){

    case 'lister':
    default:
        $page->listeAction();
        break;

    case "ajouter":
        $page->ajoutAction();
        break;

    case "supprimer":
        $page->supprimerAction();
        break;

    case "modifier":
        $page->modifierAction();
        break;

    case "details":
        $page->detailsAction();
        break;

}