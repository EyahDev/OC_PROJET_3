<?php

namespace Blog\Modele;

use Blog\Framework\Modele;
use Exception;


class Billet extends Modele {

    /**
     * Recuperation de tous les billets du blog
     *
     * @return array => Retourne les billets récuperés via l'execution de la requête SQL
     */
    public function getBillets() {
        // Définition de la requête SQL
        //$reqSQL = 'SELECT id, titre, contenu, DATE_FORMAT(billet_date, "%d/%m/%Y") AS dateFormate, SUBSTR(contenu, 1, 350) AS extrait, categorie_id, nb_com, url_img_tuiles, url_img_pres FROM billets ORDER BY billet_date DESC';
        $reqSQL =  'SELECT COUNT(c.billet_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.billet_date, "%d/%m/%Y à %H:%i") AS billet_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles
                    FROM billets b LEFT JOIN commentaires c ON c.billet_id = b.id
                    GROUP BY b.id
                    ORDER BY billet_date DESC';
        // Récuperation des billets en executant la requête
        $recupBillets = $this->executionRequete($reqSQL);

        // Retourne tous les billets récuperés
        return $recupBillets->fetchAll();
    }

    /**
     * Recuperation de tous les billets du blog pour la partie admin
     *
     * @return \PDOStatement => Retourne les billets récuperés via l'execution de la requête SQL
     */
    public function getBilletsAdmin() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.billet_id) AS nbBillet, cat.categorie, b.id, b.titre, b.contenu, DATE_FORMAT(b.billet_date, "%d/%m/%Y ") AS billet_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles
                    FROM billets b 
                    LEFT JOIN commentaires c ON c.billet_id = b.id
                    INNER JOIN categories cat On b.categorie_id = cat.id
                    GROUP BY b.id
                    ORDER BY billet_date DESC';

        // Récuperation des billets en executant la requête
        $recupBillets = $this->executionRequete($reqSQL);

        // Retourne tous les billets récuperés
        return $recupBillets;
    }

    /*SELECT COUNT(b.categorie_id), b.id, b.titre, DATE_FORMAT(b.billet_date, "%d/%m/%Y à %H:%i") AS billet_date, b.auteur_id, b.contenu, SUBSTR(b.contenu, 1, 350) AS extrait, c.id, c.categorie, u.pseudo_auteur
FROM billets b
LEFT JOIN categories c ON c.id = b.categorie_id
INNER JOIN utilisateurs u ON b.auteur_id = u.id
WHERE b.categorie_id = 1
GROUP BY b.id
ORDER BY billet_date DESC*/

    public function getBilletsCategorie($categorie) {

        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.billet_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.billet_date, "%d/%m/%Y") AS billet_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles, u.pseudo_auteur, cat.categorie
                    FROM billets b 
                    LEFT JOIN commentaires c ON c.billet_id = b.id
                    INNER JOIN categories cat ON b.categorie_id = cat.id
                    INNER JOIN utilisateurs u ON b.auteur_id = u.id
                    WHERE b.categorie_id = ?
                    GROUP BY b.id                   
                    ORDER BY billet_date DESC';


        // Récuperation des billets en executant la requête
        $recupBillet = $this->executionRequete($reqSQL, array($categorie));

        // Retourne les billet demandés si il existe bien des billets dans cette catégorie, si non il genère un message d'erreur
        if ($recupBillet->rowCount()) {
            return $recupBillet;
        } else {
            throw new Exception("Aucune catégorie ne correspond à l'identifiant '$categorie'");
        }

    }

    /**
     * Recupération d'un seul billet grâce à son id
     *
     * @param $idBillet => Identifiant du billet demandé
     * @return mixed => Retourne le resultat de la recherche
     * @throws Exception => genère un message d'erreur
     */
    public function getBillet($idBillet) {
        // Définition de la requête SQL
        /*$reqSQL = 'SELECT user.pseudo_auteur pseudo_auteur, cat.categorie categorie, bill.id id, bill.titre titre, DATE_FORMAT(bill.billet_date, "%d/%m/%Y à %H:%i") billet_date,bill.categorie_id categorie_id, bill.auteur_id auteur_id, bill.contenu contenu, bill.nb_com nb_com,bill.url_img_tuiles url_img_tuiles, bill.url_img_pres url_img_pres
                  FROM billets bill 
                  INNER JOIN utilisateurs user
                  ON bill.auteur_id = user.id
                  INNER JOIN categories cat
                  ON bill.categorie_id = cat.id
                  WHERE bill.id = ?';*/
        $reqSQL = 'SELECT COUNT(c.billet_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.billet_date, "%d/%m/%Y à %H:%i") AS billet_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles, u.pseudo_auteur, cat.categorie
                    FROM billets b 
                    LEFT JOIN commentaires c ON c.billet_id = b.id
                    INNER JOIN categories cat ON b.categorie_id = cat.id
                    INNER JOIN utilisateurs u ON b.auteur_id = u.id
                    WHERE b.id = ?
                    GROUP BY b.id                   
                    ORDER BY billet_date DESC';


        // Recuperation du billet demandé
        $recupBillet = $this->executionRequete($reqSQL, array($idBillet));

        // Retourne le billet demandé si il n'y a qu'un seul resultat, si non il genère un message d'erreur
        if ($recupBillet->rowCount() == 1) {
            return $recupBillet->fetch();
        } else {
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
        }
    }


    public function getIDBillets() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT id, categorie_id FROM billets ORDER BY categorie_id';

        // Recuperation du billet demandé
        $recupID = $this->executionRequete($reqSQL);

        return $recupID->fetchAll();
    }

    /**
     * Compte tous les billets existant dans la base de données et retourne le resultat
     *
     * @return mixed =>Retourne le nombres de billets existant dans la base de données
     */
    public function getNbBillets() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(*) AS nbBillets FROM billets';

        // Execution de la requête
        $resultat = $this->executionRequete($reqSQL);

        // Récuperation du résultats et stockage dans une variable
        $ligne = $resultat->fetch();

        // Retourne le résultat
        return $ligne['nbBillets'];
    }

    public function getNbBilletsCategorie($idCategorie) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(*) AS nbBillets FROM billets WHERE categorie_id = ?';

        // Execution de la requête
        $resultat = $this->executionRequete($reqSQL, array($idCategorie));

        // Récuperation du résultats et stockage dans une variable
        $ligne = $resultat->fetch();

        // Retourne le résultat
        return $ligne['nbBillets'];
    }

    /**
     * Création d'un nouvel article dans la base de données
     *
     * @param $titre => titre du nouvel article
     * @param $contenu => Contenu du nouvel article
     * @throws Exception => message d'erreur dans le cas ou la requête echoue
     */
    public function setNvBillet($titre, $contenu, $categorie, $urlTuile, $urlPres, $auteurId){
        $reqSQL = 'INSERT INTO billets (titre, contenu, billet_date, categorie_id, url_img_tuiles, url_img_pres, auteur_id) VALUES (:titre, :contenu, NOW(), :categorie, :urlTuile, :urlPres, :auteurId)';

        $ecriture = $this->executionRequete($reqSQL, array(
            ':titre' => $titre,
            ':contenu' => $contenu,
            ':categorie' => $categorie,
            ':urlTuile' => $urlTuile,
            ':urlPres' => $urlPres,
            ':auteurId' => $auteurId
        ));

        $count = $ecriture->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la publication du nouvel article");
        }

    }

    /**
     * Modification d'un billet
     *
     * @param $idBillet => Identifiant du billet à modifier
     * @param $titre => Titre modifié de l'article
     * @param $contenu => Contenu modifié de l'article
     * @throws Exception => Message d'erreur si la modification de l'article echoue
     * @return int => Nombre de ligne affecté par la maj
     */
    public function MAJBilet($idBillet, $titre, $contenu, $categorie, $urlTuile, $urlPres) {
        // Définition de la requête SQL
        $reqSQL = 'UPDATE billets SET titre = :titre, contenu = :contenu, categorie_id = :categorie, url_img_tuiles = :urlTuile, url_img_pres = :urlPres  WHERE id = :idBillet';

        // Execution de la requête
        $maj = $this->executionRequete($reqSQL, array(
            ':idBillet' => $idBillet,
            ':titre' => $titre,
            ':contenu' => $contenu,
            ':categorie' =>$categorie,
            ':urlTuile' => $urlTuile,
            ':urlPres' => $urlPres
        ));

        // Vérification si la ligne est bien affecté
        $count = $maj->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la modification de l'article");
        }
    }

    /**
     * Supprime le billet défini
     *
     * @param $idBillet => Identifiant du billet à supprimer
     * @return int => Retourne le nombre de ligne affecté par la requête
     * @throws Exception => erreur en cas d'échec de la suppression du billet
     */
    public function supprBillet($idBillet) {
        // Définition de la requête SQL
        $reqSQL = 'DELETE FROM billets WHERE id = ?';

        // Execution de la requête
        $suppression = $this->executionRequete($reqSQL, array($idBillet));

        // Vérification si la ligne est bien affecté
        $count = $suppression->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression de l'article");
        }

    }
}