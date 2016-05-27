<?php

// inclusion de l'autoload composer pour inclusion automatique des classes
require_once "vendor/autoload.php";

// connexion a la bdd
try{
    $pdo = new \PDO("mysql:host=localhost;dbname=kandt0","root","root");
    $pdo->query('SET NAMES \'utf8\'');
} catch(PDOException $e){
    die($e->getMessage());
}


/**
 * @param $value1
 * @param $value2
 * @return string
 */
function isActive($value1, $value2)
{
    if($value1 == $value2) {
        return 'active';
    }
    else {
        return '';
    }
}

$page = new \Controller\PageController($pdo);
$page->displayAction();