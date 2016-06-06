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
            // form to add a page
            require "View/admin/ajouterPage.php";
        } else {
            // add action
            $data = $this->repository->ajout($_POST);
            // redirection
            header('Location: index.php?a=details&id='.$data);
            exit(); // end the current script
        }

    }

    /**
     * @throws \Exception
     */
    public function supprimerAction()
    {
        if (!isset($_GET['id'])) {
            // throw an exception if the id is missing duh
            throw new\Exception('Il manque un id à l\'url');
        }
        $id = $_GET['id'];
        // delete action
        $this->repository->supprimer($id);
        // redirection
        header('Location: index.php');
        exit(); // end the current script
    }


    /**
     * @throws \Exception
     */
    public function modifierAction()
    {
        if (count($_POST) === 0) {
            if (!isset($_GET['id'])) {
                // throw an exception if the id is missing duh
                throw new\Exception('Il manque un id à l\'url');
            }
            $id = $_GET['id'];
            // find the details of one page
            $data = $this->repository->findOne($id);
            // form to update a page
            require "View/admin/modifierPage.php";
        } else {
            $data = $this->repository->modifier($_POST);
            // redirection
            header('Location: index.php');
            exit(); // end the current script
        }
    }

    /**
     *
     */
    public function detailsAction()
    {
        if(!isset($_GET['id'])) {
            // throw an exception if the id is missing duh
            throw new \Exception('Il manque un id à l\'url');
        } else {
            $id = $_GET['id'];
        }
        $data = $this->repository->findOne($id);
        if($data === false) {
            // redirect on an error page
            include "View/admin/detailsPageError.php";
            return;
        }
        // print the view of one page's details
        include "View/admin/detailsPage.php";
    }

    /**
     *
     */
    public function listeAction()
    {
        $data = $this->repository->findAll(); // cast = tout ce qui sort sera forcément un tableau
        // print the admin view = list of all the pages
        include "View/admin/index.php";
    }

    /**
     *
     */
    public function displayAction()
    {
        // get the slug of the requested page
        if(isset($_GET['p'])) {
            $slug = $_GET['p'];
        } else {
            $slug = 'done';
        }
        // get the navigation
        $nav = $this->getNav($slug);
        // get the data
        $page = $this->repository->getSlug($slug);
        // if data are false, no page
        if(!$page) {
            // 404 page
            header("HTTP/1.1 404 Not Found");
            include "View/404.php";

            // getting out of the controller
            return;
        }
        // include the view with the variables' injection
        include "View/page.php";
    }

    /**
     * @param $slug
     * @return string
     */
    private function getNav($slug)
    {
        ob_start();
        $nav = $this->repository->findAll();
        include "View/nav.php";
        if($nav === false) {
            $nav = [];
        }

        return ob_get_clean();
    }

}