<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Commentaire;

class ControleurAdmin extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $article;
    private $commentaires;

    /**
     * Instanciation des classes nécessaires
     *
     * ControleurAdmin constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->commentaires = new Commentaire();
    }

    /**
     * Récupération des éléments pour la page d'administration du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Création d'un cookie de session pour la nav
        $this->requete->getSession()->setAttribut('in', 'admin');

        // Récupération du nombre de signalements
        $nbSignalement = $this->commentaires->getNbSignalements();

        // Récupération du login de la session en cours
        $login = $this->requete->getSession()->getAttribut('login');

        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Génère la vue avec les paramètres
        $this->genererVue(array(
            'nbSignalement' => $nbSignalement,
            'login' => $login,
            'messageConfirmation' => $messageConfirmation
        ));

    }

}