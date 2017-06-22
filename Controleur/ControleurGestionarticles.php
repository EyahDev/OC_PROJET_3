<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurGestionarticles extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categories;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurGestionarticles constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
    }

    /**
     * Récupération des éléments pour la page d'administration des articles du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récuperation de tous les articles
        $article = $this->article->getArticlesAdmin();

        //Définition de variables vide pour le cas ou il n'y a rien à afficher
        $messageArticle = '';

        // Récuperation du message flash de confirmation
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Définition de la variable si aucun article ne peut être afficher
        if ($article->rowCount() == 0){
            $messageArticle = 'Il n\'y aucun article à afficher';
        }

        // Génération de la vue avec le paramètres
        $this->genererVue(array(
            'recupArticles' => $article,
            'messageArticle' => $messageArticle,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Affiche les details de l'article choisi
     */
    public function modification() {
        // Récupération de l'identifiant de l'article à modifier
        $idArticle = $this->requete->getParametre('id');
        $categories = $this->categories->getCategories()->fetchAll();

        // Récupération des informations modifiable
        $article = $this->article->getArticle($idArticle);

        // Génère la vue avec les paramètres pour la modification
        $this->genererVue(array(
            'affichageArticle' => $article,
            'categories' => $categories
        ));
    }

    /**
     * Fonction pour la suppression d'un article
     */
    public function suppression() {
        // Récuperation de l'identifiant de l'article à supprimer
        $idArticle = $this->requete->getParametre("id");

        // Suppression de l'article défini avec son identifiant
        $this->article->supprArticle($idArticle);

        // Définition du message flash
        $this->requete->getSession()->setMessageFlash('confirmation', 'La suppression de l\'article a bien été effectué');

        // Redirection vers la liste des articles
        $this->redirection('GestionArticles');
    }

    /**
     * Publication des modifications dans la base de données
     */
    public function publication() {
        // Récupération des variables modifiés
        $idArticle = $this->requete->getParametre('id');
        $titre = $this->requete->getParametre('titreModifArticle');
        $contenu = $this->requete->getParametre('contenuArticleModif');
        $categorie = $this->requete->getParametre('categorieModifArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        // Création de l'image par défaut si la variable est vide
        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        // mise à jour de l'article dans la base de données
        $MAJ = $this->article->MAJArticle($idArticle, $titre, $contenu, $categorie, $urlTuile, $urlPres);

        // Définition d'un message de confirmation si il y a eu modification ou non
        if ($MAJ == 1) {
            $this->requete->getSession()->setMessageFlash('confirmation', 'La modifiation de l\'article a été effectué.');
        } else {
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        // Redirection vers la liste de tous les articles
        $this->redirection('GestionArticles');
    }
}