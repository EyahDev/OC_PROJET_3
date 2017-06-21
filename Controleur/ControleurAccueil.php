<?php

namespace Blog\Controleur;

// Namespaces necessaires au fonctionnement du blog
use Blog\Modele\Article;
use Blog\Framework\Controleur;
use Blog\Modele\Categories;
use Blog\Modele\Commentaire;
use Blog\Modele\Utilisateur;

class ControleurAccueil extends Controleur {

    // Déclaration de la variable pour le constructeur
    private $article;
    private $categories;
    private $commentaires;
    private $utilisateurs;

    // Instantation de la classe Article
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
        $this->commentaires = new Commentaire();
        $this->utilisateurs = new Utilisateur();
    }

    /**
     * Récuperation de tout les Articles du blog et affichage de la vue accueil
     */
    public function index() {

        // Récuperation des catégories
        $categories = $this->categories->getCategories();

        // Récuperation des derniers commentaires
        $lastCommentaires = $this->commentaires->getDerniersComs();

        // Récuperation des Articles
        $Articles = $this->article->getArticlesAccueil();

        // Récuperation du nombres de commentaires par Articles
        $commentaires = $this->commentaires->getNbCommentaires();

        // Récuperation de la section A propos
        $aPropos = $this->utilisateurs->getAPropos();

        // Récuperation des messages flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'recupArticles' => $Articles,
            'derniersComs' => $lastCommentaires,
            'recupCategories' => $categories,
            'aPropos' => $aPropos,
            'nbComs' => $commentaires,
            'messageConfirmation' => $messageConfirmation
            ));
    }

    public function mailContact() {
        $to = "adrien.desmet@hotmail.fr";
        $sujet = $this->requete->getParametre('sujet');
        $message = $this->requete->getParametre('messageContact');
        $mail = $this->requete->getParametre('mail');
        $infoSupp = 'From :' .$mail;

        mail($to, $sujet, $message, $infoSupp);

        $this->requete->getSession()->setMessageFlash('confirmation', 'Votre mail a bien été envoyé');

        $this->redirection('accueil');
    }

}
