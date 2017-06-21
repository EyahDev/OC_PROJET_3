<?php

namespace Blog\Controleur;


use Blog\Framework\Controleur;
use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurCategorie extends Controleur {

    private $article;
    private $categorie;

    public function __construct() {
        $this->article = new Article();
        $this->categorie = new Categories();
    }

    public function index() {
        // Récuperation de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Récuperation du titre de la catégorie
        $titreCategorie = $this->categorie->getTitreCategorie($idCategorie);

        /* Pagination */

        // Nombres de billets par page
        $ArticlesParPage = 5;

        // Recuperation de la page en cours
        $pageActuel = $this->requete->getParametre('page');

        // page calculé
        $pageCalcule = ($pageActuel - 1) * $ArticlesParPage;

        // Nombres total d'articles
        $articlesTotal = $this->article->pagination();

        //Calcul du nombre de pages nécessaires
        $nbPagesNecessaires = $articlesTotal['nbArticles'] / $ArticlesParPage;

        // Récupération des articles lié à la catégorie
        $articles = $this->article->getArticlesCategorie($idCategorie, $pageCalcule, $ArticlesParPage);

        // Génération de la vue
        $this->genererVue(array(
            'affichageArticles' => $articles,
            'titreCat' => $titreCategorie,
            'nbPagesNecessaires' => ceil($nbPagesNecessaires)
        ));
    }

}