<?php

namespace Blog\Controleur;

use Blog\Framework\Controleur;
use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurCategorie extends Controleur {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categorie;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurCategorie constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categorie = new Categories();
    }

    /**
     * Récupération des éléments pour la page catégorie du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {

        // Récupération de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Récupération du titre de la catégorie
        $titreCategorie = $this->categorie->getTitreCategorie($idCategorie);

        /* Pagination */

        // Nombres de billets par page
        $ArticlesParPage = 5;

        // Récupération de la page actuel
        $pageActuel = $this->requete->getParametre('page');

        // Calcul de la page à afficher
        $pageCalculee = ($pageActuel - 1) * $ArticlesParPage;

        // Nombres total d'articles
        $articlesTotal = $this->article->pagination();

        //Calcul du nombre de pages nécessaires
        $nbPagesNecessaires = $articlesTotal['nbArticles'] / $ArticlesParPage;

        // Récupération des articles lié à la catégorie
        $articles = $this->article->getArticlesCategorie($idCategorie, $pageCalculee, $ArticlesParPage);

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'affichageArticles' => $articles,
            'titreCat' => $titreCategorie,
            'nbPagesNecessaires' => ceil($nbPagesNecessaires)
        ));
    }

}