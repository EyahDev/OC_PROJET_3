<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurGestionarticles extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categories;

    /**
     * Instanciation des classes nécessaires
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
        // Création d'un cookie de session pour la nav
        $this->requete->getSession()->setAttribut('in', 'gestionarticle');

        // Récupération de tous les articles
        $article = $this->article->getArticlesAdmin();

        //Définition de variables vides pour le cas où il n'y a rien à afficher
        $messageArticle = '';

        // Récupération du message flash de confirmation
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Définition de la variable si aucun article ne peut être affiché
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
     * Affiche les détails de l'article choisi
     */
    public function modification() {
        // Récupération de l'identifiant de l'article à modifier
        $idArticle = $this->requete->getParametre('id');
        $categories = $this->categories->getCategories()->fetchAll();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        // Récupération des informations modifiables
        $article = $this->article->getArticle($idArticle);

        // Génère la vue avec les paramètres pour la modification
        $this->genererVue(array(
            'affichageArticle' => $article,
            'categories' => $categories,
            'messageFlash' => $messageFlash
        ));
    }

    /**
     * Fonction pour la suppression d'un article
     */
    public function suppression() {
        // Récupération de l'identifiant de l'article à supprimer
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
        // Récupération des variables modifiées
        $idArticle = $this->requete->getParametre('id');
        $titre = $this->requete->getParametre('titreModifArticle');
        $contenu = $this->requete->getParametre('contenuArticleModif');
        $categorie = $this->requete->getParametre('categorieModifArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        if (empty($titre) || empty($contenu) || empty($categorie)) {
            if (empty($titre)) {
                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le titre de l\'article était manquant.<br/> Tous les détails ont été rechargés, mais le contenu a été sauvegardé' );

                // Sauvegarde du contenu avec un cookie de session
                $this->requete->getSession()->setAttribut('SaveContenu'.$idArticle, $contenu);

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('modification');

            } elseif (empty($categorie)) {

                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'La catégorie de l\'article était manquant.<br/> Tous les détails ont été rechargés, mais le contenu a été sauvegardé');

                // Sauvegarde du contenu avec un cookie de session
                $this->requete->getSession()->setAttribut('SaveContenu'.$idArticle, $contenu);

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('modification');

            } elseif (empty($contenu)) {

                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le contenu de l\'article est manquant');

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('modification');
            }
        } else {

            // Création de l'image par défaut si la variable est vide
            if ($urlTuile == '') {
                $urlTuile = 'Contenu/img/default/tuile_default.jpg';
            }

            if ($urlPres == '') {
                $urlPres = 'Contenu/img/default/pres_default.jpg';
            }

            // Mise à jour de l'article dans la base de données
            $MAJ = $this->article->MAJArticle($idArticle, $titre, $contenu, $categorie, $urlTuile, $urlPres);

            // Définition d'un message de confirmation si il y a eu modification ou non
            if ($MAJ == 1) {
                $this->requete->getSession()->setMessageFlash('confirmation', 'La modifiation de l\'article a été effectué.');
            } else {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
            }

            // Suppression des cookies
            unset($_SESSION['SaveCategorie'.$idArticle]);

            // Redirection vers la liste de tous les articles
            $this->redirection('GestionArticles');
        }
    }
}