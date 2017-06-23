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
     * Instanciation des classes nécessaires
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
        // Création d'un cookie de session pour la nav
        $this->requete->getSession()->setAttribut('in', 'categorie');

        // Récupération de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Récupération du titre de la catégorie
        $titreCategorie = $this->categorie->getTitreCategorie($idCategorie);

        /* Pagination */

        // Nombres de billets par page
        $ArticlesParPage = 5;

        // Récupération de la page actuelle
        $pageActuelle = $this->requete->getParametre('page');

        // Calcul de la page à afficher
        $pageCalculee = ($pageActuelle - 1) * $ArticlesParPage;

        // Nombres total d'articles
        $articlesTotal = $this->article->pagination($idCategorie);

        //Calcul du nombre de pages nécessaires si ce n'est pas une chaine alphabetique
        if (!ctype_alpha($pageActuelle)) {
            $nbPagesNecessaires = $articlesTotal['nbArticles'] / $ArticlesParPage;
        } else {
            throw new \Exception("La page '$pageActuelle' n'existe pas");
        }

        if ($pageActuelle <= ceil($nbPagesNecessaires)) {
            // Récupération des articles liés à la catégorie
            $articles = $this->article->getArticlesCategorie($idCategorie, $pageCalculee, $ArticlesParPage);

            // Génération de la vue avec les paramètres
            $this->genererVue(array(
                'affichageArticles' => $articles,
                'titreCat' => $titreCategorie,
                'nbPagesNecessaires' => ceil($nbPagesNecessaires)
            ));
        } else {
            throw new \Exception("La page '$pageActuelle' n'existe pas");
        }
    }
}