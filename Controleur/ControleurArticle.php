<?php

namespace Blog\Controleur;

// Namespaces necessaires au fonctionnement du blog
use Blog\Modele\Article;
use Blog\Modele\Commentaire;
use Blog\Framework\Controleur;


class ControleurArticle extends Controleur {

    // Déclaration des variables pour le constructeur
    private $article;
    private $commentaires;

    /**
     * Constructeur du ControleurArticle
     *
     * Instantiation des articles dans la variable $article
     * Instantiation des commentaires dans la variable $commentaires
     */
    public function __construct() {
        $this->article = new Article();
        $this->commentaires = new Commentaire();
    }

    /**
     * Action par défaut du contrôleur
     */
    public function index() {
        // Récuperation de l'identifiant du article
        $idArticle = $this->requete->getParametre('id');

        // Récupération du article et des commentaires
        $article = $this->article->getArticle($idArticle);
        $commentairesBrut = $this->commentaires->getCommentaires($idArticle);

        // préparation des commentaires pour l'affichage
        $commentaires = $this->traitementCommentaires($commentairesBrut);

        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Récuperation de tous les ids des articles
        $idArticles = $this->article->getIDArticles();

        // traitement des ids dans un tableau
        foreach ($idArticles as $id) {
            $IDs[] = $id['id'];
        }

        $prev = $this->precedent($idArticle, $IDs);
        $next = $this->suivant($idArticle, $IDs);

        // Génération de la vue
        $this->genererVue(array(
            'affichageArticle' => $article,
            'comTraites' => $commentaires,
            'messageConfirmation' => $messageConfirmation,
            'prev' => $prev,
            'next' => $next
        ));
    }
    /**
     * Affiche le article précédent
     *
     * @param $idActuel => id du article actuel
     * @param $IDs => Tableau des IDs
     * @return mixed => Retourne l'id du article précédent
     */
    public function precedent($idActuel,$IDs) {
         while (current($IDs) != $idActuel) {
            next($IDs);
        }
        return prev($IDs);
    }

    /**
     * Affiche le article suivant
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
        $idArticle = $this->requete->getParametre('id');
        $auteur = $this->requete->getParametre('auteur');
        $contenu = $this->requete->getParametre('contenu');
        $reponseID = $this->requete->getParametre('reponse');


        if ($reponseID == '') {
            $reponseID = null;
        }

        //Ecriture du commentaires dans la base de données dans la base de données
        $this->commentaires->ajoutCommentaire($auteur, $contenu, $idArticle, $reponseID);


        // Actualisation de l'affichage du article
        $this->redirection('article', 'index/'.$idArticle);
    }


    public function signaler () {
        $idArticle = $this->requete->getParametre('idArticle');
        $idCommentaires = $this->requete->getParametre('idCom');

        $recupAppprobation = $this->commentaires->getApprobation($idCommentaires);

        // Création d'un cookie pour le signalement multiple
        setcookie('signalementCom'. $idCommentaires, $idCommentaires, time()+60*60*24*30);


        if ($recupAppprobation['moderation'] != 1) {
            if (isset($_COOKIE['signalementCom'.$idCommentaires]) == $idCommentaires) {
                $this->requete->getSession()->setMessageFlash('erreur', 'Vous avez déjà signalé ce commentaire.');
            } else {
                $this->commentaires->signalement($idCommentaires);
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre signalement a bien été pris en compte, merci.');
            }
        } else {
            $this->requete->getSession()->setMessageFlash('erreur', 'Le commentaire que vous avez signalé a déjà été approuvé par le modérateur, ce n\'est plus necessaire de le signaler.');
        }


        $this->redirection('article', 'index/'.$idArticle. '#commentaires');
    }
}