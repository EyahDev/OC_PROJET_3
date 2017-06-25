<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Commentaire;
use Blog\Framework\Controleur;

class ControleurArticle extends Controleur {

    // Déclaration des variables pour le constructeur
    private $article;
    private $commentaires;

    /**
     * Instanciation des classes nécessaires
     *
     * Constructeur du ControleurArticle
     */
    public function __construct() {
        $this->article = new Article();
        $this->commentaires = new Commentaire();
    }

    /**
     * Récupération des éléments pour la page d'article du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupération de l'identifiant de l'article
        $idArticle = $this->requete->getParametre('id');

        // Récupération de l'article et de ses commentaires
        $article = $this->article->getArticle($idArticle);
        $commentairesBrut = $this->commentaires->getCommentaires($idArticle);

        // Préparation des commentaires pour l'affichage
        $commentaires = $this->traitementCommentaires($commentairesBrut);

        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Récupération de tous les identifiants des articles
        $idArticles = $this->article->getIDArticles();

        // Traitement des identifiants dans un tableau
        foreach ($idArticles as $id) {
            $IDs[] = $id['id'];
        }

        // Définition de la navigation suivant et précédent
        $prev = $this->precedent($idArticle, $IDs);
        $next = $this->suivant($idArticle, $IDs);

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'affichageArticle' => $article,
            'comTraites' => $commentaires,
            'messageConfirmation' => $messageConfirmation,
            'prev' => $prev,
            'next' => $next
        ));
    }

    /**
     * Affiche l'article précédent
     *
     * @param $idActuel => idenfiant de l'article actuel
     * @param $IDs => Tableau des identifiants
     * @return mixed => Retourne l'id de l'article précédent
     */
    public function precedent($idActuel,$IDs) {
         while (current($IDs) != $idActuel) {
            next($IDs);
        }
        return prev($IDs);
    }

    /**
     * Affiche l'article suivant
     *
     * @param $idActuel => id du article actuel
     * @param $IDs => Tableau des IDs
     * @return mixed => Retourne l'id du article suivant
     */
    public function suivant($idActuel,$IDs) {
        while (current($IDs) != $idActuel) {
            next($IDs);
        }
        return next($IDs);
    }

    /**
     * Prépare les commentaires pour l'affichage
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
     * Fonction pour que les utilisateurs puissent laisser un commentaire
     */
    public function commenter() {
        // Recuperation des informations du commentaires
        $idArticle = $this->requete->getParametre('id');
        $auteur = $this->requete->getParametre('auteur');
        $contenu = $this->requete->getParametre('contenu');
        $reponseID = $this->requete->getParametre('reponse');

        // Passage de la variable reponseID à null si la variable est vide après sa récupération
        if ($reponseID == '') {
            $reponseID = null;
        }

        if (empty($auteur) || empty($contenu)) {
            if (empty($auteur)) {
                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Votre pseudo est manquant');

                // Redirection vers l'article sections commentaires
                header('Location: index/'.$idArticle. '#commentaires');
            } elseif (empty($contenu)) {
                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Votre commentaire est manquant');

                // Redirection vers l'article sections commentaires
                header('Location: index/'.$idArticle. '#commentaires');
            }
        } else {
            //Insertion du commentaire dans la base de données
            $this->commentaires->ajoutCommentaire($auteur, $contenu, $idArticle, $reponseID);

            $this->requete->getSession()->setMessageFlash('confirmation', 'Votre commentaire a bien été publié');

            // Redirection vers l'article sections commentaires
            header('Location: index/' . $idArticle . '#commentaires');
        }
    }

    /**
     * Fonction pour le signalement des articles au contenu inapproprié
     */
    public function signaler () {
        // Récupérations des informations sur le commentaire à signaler
        $idArticle = $this->requete->getParametre('idArticle');
        $idCommentaires = $this->requete->getParametre('idCom');

        // Récupération de l'approblation du commentaire à signaler
        $recupAppprobation = $this->commentaires->getApprobation($idCommentaires);

        // Création d'un cookie pour éviter le signalement multiple (1 mois)
        setcookie('signalementCom'. $idCommentaires, $idCommentaires, time()+60*60*24*30);

        // Vérification si le commentaire à signaler a déjà été approuvé par l'administrateur et génère un message en conséquence
        if ($recupAppprobation['moderation'] != 1) {

            // Vérification si le commentaire a déjà était signalé par l'utilisateur et génère un message en conséquence
            if (isset($_COOKIE['signalementCom'.$idCommentaires]) == $idCommentaires) {
                $this->requete->getSession()->setMessageFlash('erreur', 'Vous avez déjà signalé ce commentaire');
            } else {
                $this->commentaires->signalement($idCommentaires);
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre signalement a bien été pris en compte, merci');
            }
        } else {
            $this->requete->getSession()->setMessageFlash('erreur', 'Le commentaire que vous avez signalé a déjà été approuvé par le modérateur, il n\'est plus nécessaire de le signaler');
        }

        // Redirection vers l'article en question
        $this->redirection('article', 'index/'.$idArticle. '#commentaires');
    }
}