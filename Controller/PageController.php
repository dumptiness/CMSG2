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
        if(count($_POST) === 0) {
            // formulaire
            // affichage de vue
        } else {
            // traitement de formulaire
            // sauvegarde de la nouvelle page
        }
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
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $data = $this->repository->findOne($id);
        include "View/admin/detailsPage.php";
    }

    /**
     *
     */
    public function listeAction()
    {
        $data = (array) $this->repository->findAll(); // cast = tout ce qui sort sera forcément un tableau
        include "View/admin/index.php";
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