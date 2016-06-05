<?php
namespace Controller;

use Model\PageRepository;


/**
 * Class PageController
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
        if (count($_POST) === 0) {
            require "View/admin/ajouterPage.php";
        } else {
            $data = $this->repository->ajout($_POST);
            header('Location: index.php?a=details&id='.$data);
            exit(); // termine le script courant
        }

    }

    /**
     * @throws \Exception
     */
    public function supprimerAction()
    {
        if (!isset($_GET['id'])) {
            throw new\Exception('Il manque un id à l\'url');
        }
        $id = $_GET['id'];
        $this->repository->supprimer($id);
        header('Location: index.php');
        exit();
    }


    /**
     * @throws \Exception
     */
    public function modifierAction()
    {
        if (count($_POST) === 0) {
            if (!isset($_GET['id'])) {
                throw new\Exception('Il manque un id à l\'url');
            }
            $id = $_GET['id'];
            $data = $this->repository->details($id);
            require "View/admin/modifierPage.php";
        } else {
            $data = $this->repository->modifier($_POST);
            header('Location: index.php');
            exit();
        }
    }

    /**
     *
     */
    public function detailsAction()
    {
        if(!isset($_GET['id'])) {
            throw new \Exception('Il manque un id à l\'url');
        } else {
            $id = $_GET['id'];
        }
        $data = $this->repository->findOne($id);
        if($data === false) {
            include "View/admin/detailsPageError.php";
            return;
        }
        include "View/admin/detailsPage.php";
    }

    /**
     *
     */
    public function listeAction()
    {
        $data = $this->repository->findAll(); // cast = tout ce qui sort sera forcément un tableau
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