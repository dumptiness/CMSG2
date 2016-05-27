<?php
namespace Controller;

use Model\PageRepository;

/**
 * Class PageController
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Controller
 */
class PageController
{
    /**
     * @var PageRepository
     */
    private $repository;

    /**
     * PageController constructor.
     * @param \PDO $PDO
     */
    public function __construct(\PDO $PDO)
    {
        $this->repository = new PageRepository($PDO);
    }

    /**
     *
     */
    public function ajoutAction()
    {
    }

    /**
     *
     */
    public function supprimerAction()
    {
    }

    /**
     *
     */
    public function modifierAction()
    {
    }

    /**
     *
     */
    public function detailsAction()
    {
    }

    /**
     *
     */
    public function listeAction()
    {
    }

    /**
     *
     */
    public function displayAction()
    {
        // $slug = $_GET['p'] ?? $_POST['p'] ?? 'teletubbies';
        // recuperation du slug de la page demandee
        if(isset($_GET['p'])) {
            $slug = $_GET['p'];
        } else {
            $slug = 'done';
        }
        // recuperation de la navigation
        $nav = $this->getNav($slug);
        // recuperation des donnees de la page demandee
        $page = $this->repository->getSlug($slug);
        // si les donnees sont false, pas de page correspondant
        if(!$page) {
            // page 404
            header("HTTP/1.1 404 Not Found");
            include "View/404.php";

            // sortie du controller
            return;
        }
        // inclusion de la vue avec injection des variables
        include "View/page.php";
    }


    /**
     * @param $slug
     * @return string
     */
    private function getNav($slug)
    {
        // capture de l'output et placement dans l'output buffer (ob)
        ob_start();
        $nav = $this->repository->findAll();
        // inclusion de la vue de nav
        include "View/nav.php";
        if($nav === false) {
            $nav = [];
        }

        //retour du output buffer et nettoyage du buffer
        return ob_get_clean();
    }

}