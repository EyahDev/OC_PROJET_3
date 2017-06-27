<?php

namespace Blog\Framework;

use Blog\Modele\Categories;
use Blog\Modele\Commentaire;
use Exception;

abstract class Controleur {

    // Action à réaliser
    private $action;
    private $navCategories;
    private $signalement;


    /**
     * Variable pour le stockage de la requête entrante
     *
     * @var Requete
     */
    protected $requete;

    public function setRequete(Requete $requete){
        $this->requete = $requete;
    }


    public function executerAction($action) {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        } else {
            $classeControleur = get_class($this);
            throw new Exception("Action '$action' non défini dans la classe $classeControleur");
        }
    }

    // Fonction qui gère les actions par défauts (pour les enfants)
    public abstract function index();


    /**
     * @param array $donneesVue
     */
    protected function genererVue($donneesVue = array()) {
        $this->navCategories = new Categories();
        $this->signalement = new Commentaire();

        // Récuperation du nom de la classe
        $classeControleur = get_class($this);

        // Recherche le mot Controleur et le remplace par du vide dans la chaine de caractère $classeControleur
        $controleur = str_replace("Blog\Controleur\Controleur", "", $classeControleur);

        // instanciation et affichage de la vue
        $vue = new Vue($this->action, $controleur);

        $navCategories =  $this->navCategories->getCategories()->fetchAll();
        $nbSignalements = $this->signalement->getNbSignalements();

        $vue->affichageVue($donneesVue, $navCategories, $nbSignalements);
    }

    protected function redirection($controleur, $action = null) {
        $racineWeb = Configuration::get("racineWeb", '/');

        // Redirection
        header("location:" . $racineWeb . $controleur .'/'.$action);
    }

}