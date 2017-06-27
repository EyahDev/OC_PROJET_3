<?php

namespace Blog\Controleur;

use Blog\Modele\Commentaire;

class ControleurSignalement extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $commentaire;

    /**
     * Instanciation des classes nécessaires
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

        // Définition de variables vides pour le cas où il n'y a rien à afficher
        $aucunComsSignales = '';
        $aucunComsApprouves = '';

        // Vérification si il y a des messages à afficher et affiche un message dans le cas où il n'y en a pas
        if ($commentaires->rowCount() == 0) {
            $aucunComsSignales = 'Aucun commentaires n\'a été signalé';
        }

        if ($commentairesApprouves->rowCount() == 1) {
            $aucunComsApprouves = 'Vous n\'avez approuvé aucun commentaire';
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
     * Affiche les details du commentaire signalé
     */
    public function details() {
        // Récupération de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Affiche les détails du commentaire signalé
        $details = $this->commentaire->getSignalement($idCommentaire);

        // Définition d'une variable vide dans le cas où il n'y a pas de réponse au commentaire
        $recupReponse = '';

        // Vérification si il y a une réponse au commentaire
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
     * Supprime l'article signalé
     */
    public function suppression() {
        // Récupération de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Supprime le commentaire défini
        $this->commentaire->suppression($idCommentaire);

        // Definition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été supprimé');

        // Redirige vers l'index des signalements
        $this->redirection('signalement');
    }

    public function suppressionDirect() {

        // Récupération de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        $idArticle = $this->commentaire->getIDArticle($idCommentaire)->fetch();

        // Supprime le commentaire défini
        $this->commentaire->suppression($idCommentaire);

        // Définition du message flash
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été supprimé');

        // Redirige sur l'article section commentaires
        $this->redirection('article', 'index/'.$idArticle['article_id']. '#commentaires');
    }

    /**
     * Approuve l'article signalé
     */
    public function approuver() {
        // Récupération de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Approbation du commentaire défini
        $this->commentaire->approbation($idCommentaire);

        // Définition du message flash
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été approuvé');

        // Redirige vers l'index des signalements
        $this->redirection('signalement');
    }


}