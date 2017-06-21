<?php

namespace Blog\Controleur;


use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurNouvelArticle extends ControleurSecurise
{

    /**
     * @var article => Variable utile au constructeur
     */
    private $article;
    private $categories;

    /**
     * ControleurNouvelArticle constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
    }

    /*
     * Action par défaut du contrôleur
     */
    public function index() {
        $recupCategories = $this->categories->getCategories()->fetchAll();

        $this->genererVue(array('categories' => $recupCategories));
    }

    /**
     * Publication du Nouvel article dans la base de données
     */
    public function publication() {
        //
        // Recuperation des informations du Nouvel article
        $auteur = $this->requete->getParametre('auteurNvArticle');
        $titre = $this->requete->getParametre('titreNvArticle');
        $contenu = $this->requete->getParametre('contenuNvArticle');
        $categorie = $this->requete->getParametre('categorieNvArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        $this->article->setNvArticle($titre, $contenu, $categorie, $urlTuile, $urlPres, $auteur);


        // Définition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nouvel article a bien été publié.');

        $this->redirection('admin');

    }
}
