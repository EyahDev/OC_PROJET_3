<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurNouvelarticle extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categories;

    /**
     * Instanciation des classes nécessaires
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
        // Création d'un cookie de session pour la nav
        $this->requete->getSession()->setAttribut('in', 'nouvelarticle');

        // Récupératon de toutes les catégories
        $recupCategories = $this->categories->getCategories()->fetchAll();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'categories' => $recupCategories,
            'messageFlash' => $messageFlash
        ));
    }

    /**
     * Fonction pour la publication d'un nouvel article
     */
    public function publication() {

        // Récupération des informations du nouvel article
        $auteur = $this->requete->getParametre('auteurNvArticle');
        $titre = $this->requete->getParametre('titreNvArticle');
        $contenu = $this->requete->getParametre('contenuNvArticle');
        $categorie = $this->requete->getParametre('categorieNvArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');


        if (empty($titre) || empty($contenu) || empty($categorie)) {
            if (empty($titre)) {
                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le titre de l\'article est manquant');

                // Sauvegarde du contenu avec un cookie de session
                $this->requete->getSession()->setAttribut('SaveNvContenu',$contenu);

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('index');

            } elseif (empty($categorie)) {

                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'La catégorie de l\'article est manquante');

                // Sauvegarde du contenu avec un cookie de session
                $this->requete->getSession()->setAttribut('SaveNvContenu',$contenu);

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('index');

            } elseif (empty($contenu)) {

                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le contenu de l\'article est manquant');

                // Redirection vers la page de création d'un nouvel article
                $this->executerAction('index');
            }
        } else {

            // Création d'une image par défaut dans le cas où la variable est vide
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

            // Suppression des cookies
            unset($_SESSION['SaveNvContenu']);



            // Redirection vers la page d'administration
            $this->redirection('admin');
        }
    }
}
