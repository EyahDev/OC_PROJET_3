<?php

namespace Blog\Controleur;


use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurGestionArticles extends ControleurSecurise {

    /**
     * @var article => variable utile au constructeur
     */
    private $article;
    private $categories;

    /**
     * ControleurGestionArticles constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
    }

    /**
     * Action par défaut du constructeur
     */
    public function index() {
        // Récuperation de tous les articles dans la base de données
        $article = $this->article->getArticlesAdmin();

        //Définition de variables vide pour le cas ou il n'y a rien à afficher
        $messageArticle = '';

        // Récuperation du message flash de confirmation
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        if ($article->rowCount() == 0){
            $messageArticle = 'Il n\'y aucun article à afficher';
        }

        $this->genererVue(array(
            'recupArticles' => $article,
            'messageArticle' => $messageArticle,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Affiche les details du article choisi
     */
    public function modification() {
        // Récupération de l'identifiant du article à modifier
        $idArticle = $this->requete->getParametre('id');
        $categories = $this->categories->getCategories()->fetchAll();

        // Récuperation des informations modifiable
        $article = $this->article->getArticle($idArticle);

        // Génère la vue pour l'affichage
        $this->genererVue(array(
            'affichageArticle' => $article,
            'categories' => $categories
        ));
    }

    public function suppression() {
        // Récuperation de l'identifiant du article à supprimer
        $idArticle = $this->requete->getParametre("id");

        // Suppression du article défini avec son identifiant
        $this->article->supprArticle($idArticle);

        // Définition du message flash à afficher lorsque le message a été supprimer
        $this->requete->getSession()->setMessageFlash('confirmation', 'La suppression de l\'article a bien été effectué');

        // Redirection vers la liste des article
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

        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        // mise à jour du article dans la base de données
        $MAJ = $this->article->MAJArticle($idArticle, $titre, $contenu, $categorie, $urlTuile, $urlPres);

        if ($MAJ == 1) {
            // Définition du message de confirmation
            $this->requete->getSession()->setMessageFlash('confirmation', 'La modifiation de l\'article a été effectué.');
        } else {
            // Définition du message de confirmation
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        // Redirection vers la liste de tous les articles
        $this->redirection('GestionArticles');
    }
}