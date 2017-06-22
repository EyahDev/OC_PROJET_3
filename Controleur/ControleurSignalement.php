<?php

namespace Blog\Controleur;

use Blog\Modele\Commentaire;

class ControleurSignalement extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $commentaire;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurSignalement constructor.
     */
    public function __construct() {
        $this->commentaire = new Commentaire();
    }

    /**
     * Récupération des éléments pour la page des signalements des commentaires du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupération de tous les commentaires signalés
        $commentaires = $this->commentaire->getSignalements();

        // Récupération de tous les commentaires approuvés
        $commentairesApprouves = $this->commentaire->getSignalementsApprouvés();

        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Définition de variables vide pour le cas ou il n'y a rien à afficher
        $aucunComsSignales = '';
        $aucunComsApprouves = '';

        // vérification si y a des messages à afficher et affiche un message dans le cas ou il n'y en a pas
        if ($commentaires->rowCount() == 0) {
            $aucunComsSignales = 'Aucun commentaires n\'a été signalés';
        }

        if ($commentairesApprouves->rowCount() == 1) {
            $aucunComsApprouves = 'Vous n\'avez approuvé aucun commentaires';
        }

        // Génère la vue avec les paramètres
        $this->genererVue(array(
            'recupCommentaires' => $commentaires,
            'recupCommentairesApprouves' => $commentairesApprouves,
            'messageSignalement' => $aucunComsSignales,
            'messageApprobation' => $aucunComsApprouves,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Affiche les details du commentaires signalé
     */
    public function details() {
        // Récuperation de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Affiche les details du commentaire signalé
        $details = $this->commentaire->getSignalement($idCommentaire);

        // Définition d'une variable vide dans le cas ou il n'y a pas de réponse au commentaire
        $recupReponse = '';

        // Vérification si il y a un réponse au commentaire
        if ($details['reponse_id']) {
            // Edition de la variable avec l'identifiant de la réponse
            $recupReponse = $this->commentaire->getReponse($details['reponse_id']);
        }

        // Genère la vue avec les paramètres
        $this->genererVue(array(
                'details' => $details,
                'reponse' => $recupReponse
            ));
    }

    /**
     * Supprime le article signalé
     */
    public function suppression() {
        // Récuperation de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Supprime le commentaire défini
        $this->commentaire->suppression($idCommentaire);

        // Definition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été supprimé');

        // Redirige vers l'index des signalements
        $this->redirection('signalement');
    }

    public function suppressionDirect() {

        // Récuperation de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        $idArticle = $this->commentaire->getIDArticle($idCommentaire)->fetch();

        // Supprime le commentaire défini
        $this->commentaire->suppression($idCommentaire);

        // Definition du message flash
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été supprimé');

        // Redirige sur le article section commentaires
        $this->redirection('article', 'index/'.$idArticle['article_id']. '#commentaires');
    }

    /**
     * Approuve le article signalé
     */
    public function approuver() {
        // Récuperation de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Approbation du commentaire défini
        $this->commentaire->approbation($idCommentaire);

        // Definition du message flash
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été approuvé');

        // Redirige vers l'index des signalements
        $this->redirection('signalement');
    }


}