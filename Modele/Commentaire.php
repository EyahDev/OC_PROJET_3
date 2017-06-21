<?php

namespace Blog\Modele;

use Blog\Framework\Modele;
use Exception;

class Commentaire extends Modele {

    /*LECTURE, ECRITURE ET SUPPRESSION DES COMMENTAIRES DANS LA BASE DE DONNEES */

    /**
     * Recherche des commentaires lié au article demandé
     *
     * @param $idArticle => Identifiant du article lié aux commentaires
     * @return mixed => Retourne les commentaires recherchés
     */
    public function getCommentaires($idArticle) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT id, reponse_id, article_id, DATE_FORMAT(com_date, "le %d/%m/%Y à %H:%i") AS dateFormate, auteur, contenu, signalement FROM commentaires WHERE article_id = ? ORDER BY dateFormate DESC';

        // Récuperation des commentaires liés au article demandé
        $recupCommentaires = $this->executionRequete($reqSQL, array($idArticle));

        // Retourne le resultat
        return $recupCommentaires;
    }

    /**
     * Ecriture d'un commentaire dans la base de données
     *
     * @param $auteur => Auteur du commentaire
     * @param $contenu => Contenu du commentaire
     * @param $idArticle => L'identifiant du article ciblé par le commentaire
     * @param $reponse_id => L'identifiant du commentaire en réponse
     */
    public function ajoutCommentaire($auteur, $contenu, $idArticle, $reponse_id = null) {
        // Définition de la requête SQL
        $reqSQL = 'INSERT INTO commentaires (com_date, auteur, contenu, article_id, reponse_id) VALUES (NOW(), :auteur, :contenu, :article_id, :reponse_id)';

        // Exécution de la requête SQL avec les paramètres en tableau
        $this->executionRequete($reqSQL, array(
            ':auteur' => $auteur,
            ':contenu' => $contenu,
            ':article_id' => $idArticle,
            ':reponse_id' => $reponse_id
        ));
    }


    /**
     * Supprime le commentaire demandé
     *
     * @param $idCommentaire => Identifiant du commentaire à supprimer
     * @return int => Retourne le nombre de ligne affecté
     * @throws Exception => Message d'erreur si la suppression a échoué
     */
    public function supprCommentaire($idCommentaire) {
        // Définition de la requête SQL
        $reqSQL = 'DELETE FROM commentaires WHERE id = ?';

        // Suppression du commentaire demandé
        $suppression = $this->executionRequete($reqSQL, array($idCommentaire));

        // Vérification si la ligne est bien affecté
        $count = $suppression->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression du commentaire");
        }
    }

    public function getDerniersComs() {
        // Définition de la requête SQL
        $reqSQL =
            'SELECT bill.titre titre, com.id id, DATE_FORMAT(com.com_date, "%d/%m/%Y à %H:%i") com_date, com.auteur auteur, com.contenu contenu, com.article_id article_id 
              FROM commentaires com 
              INNER JOIN articles bill 
              ON bill.id = com.article_id
              ORDER BY com.com_date DESC LIMIT 0,3';

        // recuperations des derniers commentaires
        $recupDerniersCom = $this->executionRequete($reqSQL);

        // Retourne les commentaires trouvés
        return $recupDerniersCom;
    }


    /**
     * Compte le nombre total de commentaires
     *
     * @return mixed => retourne le nombres de commentaires
     */
    public function getNbCommentaires() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.article_id) AS nbArticle, b.id
                    FROM commentaires c RIGHT JOIN articles b ON c.article_id = b.id
                    GROUP BY b.id';

        // Exécution de la requête
        $resultat = $this->executionRequete($reqSQL);

        // Recuperation du résultat
        return $resultat->fetchAll();
    }

    public function getIDArticle($idCommentaires) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT article_id FROM commentaires WHERE id = ?';

        // Recuperation du article demandé
        $recupID = $this->executionRequete($reqSQL, array($idCommentaires));

        var_dump($idCommentaires);

        return $recupID;
    }


    /* SIGNALEMENT ET APPROBATION*/


    /**
     * Récuperation des commentaires signalés dans la base de données
     *
     * @return \PDOStatement => Retourne les commentaires signalés
     */
    public function getSignalements() {
        // Définition de la requête SQL
        $reqSQL =
            'SELECT bill.titre titre, com.id id, com.com_date com_date, com.auteur auteur, com.contenu contenu, com.article_id article_id, com.signalement signalement, com.moderation moderation 
              FROM commentaires com 
              INNER JOIN articles bill 
              ON bill.id = com.article_id
              WHERE com.signalement > 0 AND com.moderation = 0';

        // Récuperation des commentaires liés au article demandé
        $recupCommentaires = $this->executionRequete($reqSQL);

        // Retourne tous les commentaires recuperés
        return $recupCommentaires;
    }

    public function getNbSignalements () {
        $reqSQL = 'SELECT COUNT(signalement) AS count FROM commentaires WHERE signalement > 0 AND moderation = 0';

        $nbSignalement =  $this->executionRequete($reqSQL);

        return $nbSignalement->fetch();
    }

    /**
     * Récuperation des commentaires approuvés dans la base de données
     *
     * @return \PDOStatement => Retourne les commentaires approuvés
     */
    public function getSignalementsApprouvés() {
        // Définition de la requête SQL
        $reqSQL =
            'SELECT bill.titre titre, com.id id, com.com_date com_date, com.auteur auteur, com.contenu contenu, com.article_id article_id, com.signalement signalement, com.moderation moderation 
              FROM commentaires com 
              INNER JOIN articles bill 
              ON bill.id = com.article_id
              WHERE com.moderation = 1';

        // Récuperation des commentaires liés au article demandé
        $recupCommentaires = $this->executionRequete($reqSQL);

        // Retourne tous les commentaires recuperés
        return $recupCommentaires;
    }

    /**
     * Récupération des détails du commentaire signalé
     *
     * @param $idCommentaires => identifiant du commentaire signalé
     * @return mixed => Retourne les details du commentaire signalé
     * @throws Exception => message d'erreur dans le cas ou l'idenfiant n'existe pas
     */
    public function getSignalement($idCommentaires) {
        // Définition de la requête SQL
        $reqSQL ='SELECT bill.titre titre, com.id id, com.com_date com_date, com.auteur auteur, com.contenu contenu, com.reponse_id reponse_id, com.article_id article_id, com.signalement signalement , com.moderation moderation
              FROM commentaires com 
              INNER JOIN articles bill 
              ON bill.id = com.article_id
              WHERE com.id = ?';

        // Récuperation des commentaires liés au article demandé
        $recupCommentaire = $this->executionRequete($reqSQL, array($idCommentaires));

        // Retourne les details du commentaires ou lève une erreur
        if ($recupCommentaire->rowCount() == 1) {
            return $recupCommentaire->fetch();
        } else {
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$idCommentaires'");
        }
    }

    public function getReponse($idReponse) {
        $reqSQL ='SELECT id, auteur, contenu FROM commentaires WHERE id = ?';

        $recupReponse = $this->executionRequete($reqSQL, array($idReponse));

        return $recupReponse->fetch();

    }

    public function getApprobation($idCommentaire) {
        $reqSQL = 'SELECT moderation FROM commentaires WHERE id = ?';

        $recupApprobation = $this->executionRequete($reqSQL, array($idCommentaire));

        return $recupApprobation->fetch();
    }

    /**
     * Approbation du commentaire signalé
     *
     * @param $idCommentaire => identifiant du commentaire à approuver
     * @return int => Retourne le nombre de ligne affecté par l'approbation
     * @throws Exception => message d'erreur si l'approbation echoue
     */
    public function approbation($idCommentaire) {
        // Définition de la requête SQL
        $reqSQL = 'UPDATE commentaires SET moderation = 1 WHERE id = ?';

        // Approbation du commentaire dans la base de données
        $approbation = $this->executionRequete($reqSQL, array($idCommentaire));

        // Récupération du nombre de ligne affecté
        $count= $approbation->rowCount();

        // AFfiche un message d'erreur si le nombre de ligne est null
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec l'approbation du commentaire");
        }
    }

    /**
     * Supprime le commentaire signalé
     *
     * @param $idCommentaire => Identifiant du commentaire à supprimer
     * @return int => Retourne le nombre de ligne affecté par la suppression
     * @throws Exception => Message d'erreur si la suppression echoue
     */
    public function suppression($idCommentaire) {
        // Définition de la requête SQL
        $reqSQL = 'DELETE FROM commentaires WHERE id = ?';

        // Suppression du commentaire dans la base de données
        $suppression = $this->executionRequete($reqSQL, array($idCommentaire));

        // Récupération du nombre de ligne affecté
        $count = $suppression->rowCount();

        // AFfiche un message d'erreur si le nombre de ligne est null
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression du commentaire");
        }
    }

    /**
     * Signalement du commentaire ciblé dans la base de données
     *
     * @param $idCommentaire => identifiant du commentaire à signaler
     */
    public function signalement ($idCommentaire) {
        // Définition de la requête SQL
        $reqSQL = 'UPDATE commentaires SET signalement = signalement + 1 WHERE id = ?';

        // Signalement du commentaire dans la base de donnée
        $this->executionRequete($reqSQL, array($idCommentaire));
    }


}