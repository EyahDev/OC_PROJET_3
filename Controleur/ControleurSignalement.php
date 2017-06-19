<?php

namespace Blog\Controleur;


use Blog\Modele\Commentaire;
use PDO;


class ControleurSignalement extends ControleurSecurise {

    /**
     * @var commentaire => utile pour la construction du contrôleur
     */
    private $commentaire;

    /**
     * ControleurSignalement constructor.
     */
    public function __construct() {
        $this->commentaire = new Commentaire();
    }

    /**
     * Action par défaut lors de l'accès au contrôleur
     *
     * Affiche l'intégralité des commentaires signalés et approuvés
     */
    public function index() {
        // Récupération de tous les commentaires signalés
        $commentaires = $this->commentaire->getSignalements();

        // Récupération de tous les commentaires approuvés
        $commentairesApprouves = $this->commentaire->getSignalementsApprouvés();

        // récuperation du message flash de confirmation
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

        // Génère la vue avec les parametres necessaires
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

        // Genère la vue details
        $this->genererVue(array(
                'details' => $details
            ));
    }

    /**
     * Supprime le billet signalé
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

        $idBillet = $this->commentaire->getIDBillet($idCommentaire)->fetch();

        // Supprime le commentaire défini
        $this->commentaire->suppression($idCommentaire);

        // Definition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été supprimé');

        // Redirige sur le billet section commentaire
        $this->redirection('billet', 'index/'.$idBillet['billet_id']. '#commentaires');
    }

    /**
     * Approuve le billet signalé
     */
    public function approuver() {
        // Récuperation de l'id du commentaire
        $idCommentaire = $this->requete->getParametre('id');

        // Approbation du commentaire défini
        $this->commentaire->approbation($idCommentaire);

        // Definition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation','Le commentaire a bien été approuvé');

        // Redirige vers l'index des signalements
        $this->redirection('signalement');
    }


}