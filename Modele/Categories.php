<?php

namespace Blog\Modele;

use Exception;
use Blog\Framework\Modele;

class Categories extends Modele {

    /**
     * Recuperation de toutes les catégories existantes
     *
     * @return \PDOStatement => Retourne toutes les catégories existantes
     */
    public function getCategories () {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(b.categorie_id) AS nbArticles, c.id, c.categorie, c.url_img_pres FROM categories c LEFT JOIN articles b ON b.categorie_id = c.id GROUP BY c.id';

        // Recuperation des catégories
        $recupCategories = $this->executionRequete($reqSQL);

        // Retourne les catégories
        return $recupCategories;
    }

    /**
     * Récuperation d'une catégorie défini par son identifiant
     *
     * @param $idCategorie => Identifiant de la catégorie
     * @return \PDOStatement => Retourne la catégorie defini par l'identifiant
     */
    public function getCategorie ($idCategorie) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT * FROM categories WHERE id = ?';

        // Recuperation des catégories
        $recupCategorie = $this->executionRequete($reqSQL, array($idCategorie));


        // Retourne la catégorie demandée si il n'y a qu'un seul resultat, si non il genère un message d'erreur
        if ($recupCategorie->rowCount()) {
            return $recupCategorie->fetch();
        } else {
            throw new Exception("Aucune catégorie ne correspond à l'identifiant '$idCategorie'");
        }

    }


    /**
     * Récuperation du titre d'une catégorie par son id
     *
     * @param $idCategorie => identifiant de la catégorie
     * @return \PDOStatement => Retourne le titre de la catégorie
     */
    public function getTitreCategorie($idCategorie) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT id, categorie, url_img_pres FROM categories WHERE id = ?';

        // Récupération du titre de la catégorie
        $recupTitreCat = $this->executionRequete($reqSQL, array($idCategorie));

        if ($recupTitreCat->rowCount()) {
            // Retourne le titre de la catégorie
            return $recupTitreCat->fetch();
        } else {
            throw new Exception("Aucune catégorie ne correspond à l'identifiant '$idCategorie'");
        }

    }

    public function setNvCategorie($nomCategorie, $urlPres){
        $reqSQL = 'INSERT INTO categories (categorie, url_img_pres) VALUES (:nomCategorie, :urlPres)';

        $ecriture = $this->executionRequete($reqSQL, array(
            ':nomCategorie' => $nomCategorie,
            ':urlPres' => $urlPres
        ));

        $count = $ecriture->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la creation de la catégorie");
        }

    }

    public function suppressionCategorie($idCategorie) {
        $reqSQL = 'DELETE FROM categories WHERE id = ?';

        $suppression = $this->executionRequete($reqSQL, array($idCategorie));

        // Vérification si la ligne est bien affecté
        $count = $suppression->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affecté
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression de la catégorie");
        }

    }

    public function MAJCategorie ($categorie, $idCategorie, $urlPres) {

        $reqSQL = 'UPDATE categories SET categorie = :categorie, url_img_pres = :urlPres WHERE id = :idCategorie';

        $maj = $this->executionRequete($reqSQL, array(
            ':categorie' => $categorie,
            ':idCategorie' => $idCategorie,
            ':urlPres' => $urlPres
        ));

        return $maj->rowCount();
    }
}