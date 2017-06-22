<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurNouvelarticle extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categories;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurNouvelarticle constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
    }

    /**
     * Récupération des éléments pour la page d'administration d'un nouvel article du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupératon de tous les catégories
        $recupCategories = $this->categories->getCategories()->fetchAll();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'categories' => $recupCategories
        ));
    }

    /**
     * Fonction pour la publication d'un nouvel article
     */
    public function publication() {
        // Recuperation des informations du nouvel article
        $auteur = $this->requete->getParametre('auteurNvArticle');
        $titre = $this->requete->getParametre('titreNvArticle');
        $contenu = $this->requete->getParametre('contenuNvArticle');
        $categorie = $this->requete->getParametre('categorieNvArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        // Création d'une image pas défaut dans le cas ou la variable est vide
        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        // Création du nouvel article dans la base de données
        $this->article->setNvArticle($titre, $contenu, $categorie, $urlTuile, $urlPres, $auteur);

        // Définition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nouvel article a bien été publié.');

        // Redirection vers la page d'administration
        $this->redirection('admin');
    }
}
