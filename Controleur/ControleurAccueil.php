<?php

namespace Blog\Controleur;

// Namespaces necessaires au fonctionnement du blog
use Blog\Modele\Billet;
use Blog\Framework\Controleur;
use Blog\Modele\Categories;
use Blog\Modele\Commentaire;
use Blog\Modele\Utilisateur;

class ControleurAccueil extends Controleur {

    // Déclaration de la variable pour le constructeur
    private $billet;
    private $categories;
    private $commentaires;
    private $utilisateurs;

    // Instantation de la classe Billet
    public function __construct() {
        $this->billet = new Billet();
        $this->categories = new Categories();
        $this->commentaires = new Commentaire();
        $this->utilisateurs = new Utilisateur();
    }

    /**
     * Récuperation de tout les billets du blog et affichage de la vue accueil
     */
    public function index() {

        // Récuperation des catégories
        $categories = $this->categories->getCategories();

        // Récuperation des derniers commentaires
        $lastCommentaires = $this->commentaires->getDerniersComs();

        // Récuperation des billets
        $billets = $this->billet->getBillets();

        // Récuperation du nombres de commentaires par billets
        $commentaires = $this->commentaires->getNbCommentaires();

        // Récuperation de la section A propos
        $aPropos = $this->utilisateurs->getAPropos();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'recupBillets' => $billets,
            'derniersComs' => $lastCommentaires,
            'recupCategories' => $categories,
            'aPropos' => $aPropos,
            'nbComs' => $commentaires
            ));
    }

}
