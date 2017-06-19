<?php

namespace Blog\Controleur;

// Namespaces necessaires au fonctionnement du blog
use Blog\Modele\Billet;
use Blog\Modele\Commentaire;
use Blog\Framework\Controleur;


class ControleurBillet extends Controleur {

    // Déclaration des variables pour le constructeur
    private $billet;
    private $commentaires;

    /**
     * Constructeur du ControleurBillet
     *
     * Instantiation des billets dans la variable $billet
     * Instantiation des commentaires dans la variable $commentaires
     */
    public function __construct() {
        $this->billet = new Billet();
        $this->commentaires = new Commentaire();
    }

    /**
     * Action par défaut du contrôleur
     */
    public function index() {
        // Récuperation de l'identifiant du billet
        $idBillet = $this->requete->getParametre('id');

        // Récupération du billet et des commentaires
        $billet = $this->billet->getBillet($idBillet);
        $commentairesBrut = $this->commentaires->getCommentaires($idBillet);

        // préparation des commentaires pour l'affichage
        $commentaires = $this->traitementCommentaires($commentairesBrut);

        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Récuperation de tous les ids des billets
        $idBillets = $this->billet->getIDBillets();

        // traitement des ids dans un tableau
        foreach ($idBillets as $id) {
            $IDs[] = $id['id'];
        }

        $prev = $this->precedent($idBillet, $IDs);
        $next = $this->suivant($idBillet, $IDs);

        // Génération de la vue
        $this->genererVue(array(
            'affichageBillet' => $billet,
            'comTraites' => $commentaires,
            'messageConfirmation' => $messageConfirmation,
            'prev' => $prev,
            'next' => $next
        ));
    }
    /**
     * Affiche le billet précédent
     *
     * @param $idActuel => id du billet actuel
     * @param $IDs => Tableau des IDs
     * @return mixed => Retourne l'id du billet précédent
     */
    public function precedent($idActuel,$IDs) {
         while (current($IDs) != $idActuel) {
            next($IDs);
        }
        return prev($IDs);
    }

    /**
     * Affiche le billet suivant
     *
     * @param $idActuel => id du billet actuel
     * @param $IDs => Tableau des IDs
     * @return mixed => Retourne l'id du billet suivant
     */
    public function suivant($idActuel,$IDs) {
        while (current($IDs) != $idActuel) {
            next($IDs);
        }
        return next($IDs);
    }

    /**
     * Prepare les commentaires pour l'affichage
     *
     * @return mixed => Retourne les commentaires triés
     */
    public function traitementCommentaires($commentairesBrut) {
        $commentaires = array(
            'Com' => [],
            'reponseCom' => []
            );
        foreach ($commentairesBrut AS $traitement) {
            if ($traitement['reponse_id'] == 0) {
                $commentaires['Com'][] = $traitement;
            } else {
                $commentaires['reponseCom'][$traitement['reponse_id']][] = $traitement;
            }
        }
        return $commentaires;
    }

    /**
     * Ecriture du commentaires dans la base de données et actualisation de la page pour l'affichage du commentaires
     *
     */
    public function commenter() {
        // Recuperation des informations du commentaires
        $idBillet = $this->requete->getParametre('id');
        $auteur = $this->requete->getParametre('auteur');
        $contenu = $this->requete->getParametre('contenu');
        $reponseID = $this->requete->getParametre('reponse');


        if ($reponseID == '') {
            $reponseID = null;
        }

        //Ecriture du commentaires dans la base de données dans la base de données
        $this->commentaires->ajoutCommentaire($auteur, $contenu, $idBillet, $reponseID);


        // Actualisation de l'affichage du billet
        $this->redirection('billet', 'index/'.$idBillet);
    }


    public function signaler () {
        $idBillet = $this->requete->getParametre('idBillet');
        $idCommentaires = $this->requete->getParametre('idCom');

        $recupAppprobation = $this->commentaires->getApprobation($idCommentaires);

        if ($recupAppprobation['moderation'] != 1) {
            $this->commentaires->signalement($idCommentaires);
            $this->requete->getSession()->setMessageFlash('confirmation', 'Votre signalement a bien été pris en compte, merci.');
        } else {
            $this->requete->getSession()->setMessageFlash('erreur', 'Le commentaire que vous avez signalé a déjà été approuvé par le modérateur, ce n\'est plus necessaire de le signaler.');
        }


        $this->redirection('billet', 'index/'.$idBillet. '#commentaires');
    }
}