<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Framework\Controleur;
use Blog\Modele\Categories;
use Blog\Modele\Commentaire;
use Blog\Modele\Utilisateur;

class ControleurAccueil extends Controleur {

    // Déclaration des variables pour le constructeur
    private $article;
    private $categories;
    private $commentaires;
    private $utilisateur;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurAccueil constructor.
     */
    public function __construct() {
        $this->article = new Article();
        $this->categories = new Categories();
        $this->commentaires = new Commentaire();
        $this->utilisateur = new Utilisateur();
    }

    /**
     * Récupération des éléments pour la page d'accueil du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {

        // Récupération des catégories
        $categories = $this->categories->getCategories();

        // Récupération des derniers commentaires
        $lastCommentaires = $this->commentaires->getDerniersComs();

        // Récupération des Articles
        $Articles = $this->article->getArticlesAccueil();

        // Récupération du nombres de commentaires par Articles
        $commentaires = $this->commentaires->getNbCommentaires();

        // Récupération de la section A propos
        $aPropos = $this->utilisateur->getAPropos();

        // Récupération du messages flash
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

    /**
     * Formulaire de contact : envoi d'un mail avec les élements notés par l'utilisateur à l'adresse mail de l'administrateur
     */
    public function mailContact() {
        // Récupération de l'adresse mail de l'administrateur
        $to = $this->utilisateur->getMail();

        // Récupération de l'adresse mail de l'utilisateur
        $mail = $this->requete->getParametre('mail');

        // Récupération du sujet du mail
        $sujet = $this->requete->getParametre('sujet');

        // Récupération du message
        $message = $this->requete->getParametre('messageContact');

        // Information supplémentaires pour la fonction mail : ajout de l'adresse mail de l'expediteur
        $infoSupp = 'From :' .$mail;

        // Envoi du mail à l'adresse de l'administrateur
        mail($to, $sujet, $message, $infoSupp);

        // Définition d'un message flash pour la confirmation d'envoi
        $this->requete->getSession()->setMessageFlash('confirmation', 'Votre mail a bien été envoyé');

        // Redirection sur l'accueil
        $this->redirection('accueil');
    }

}
