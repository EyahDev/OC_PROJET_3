<?php

namespace Blog\Modele;

use Exception;
use Blog\Framework\Modele;

class Categories extends Modele {

    /**
     * Récupération de toutes les catégories existantes
     *
     * @return \PDOStatement => Retourne toutes les catégories existantes
     */
    public function getCategories () {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(b.categorie_id) AS nbArticles, c.id, c.categorie, c.url_img_pres FROM categories c LEFT JOIN articles b ON b.categorie_id = c.id GROUP BY c.id';

        // Récupération des catégories
        $recupCategories = $this->executionRequete($reqSQL);

        // Retourne les catégories
        return $recupCategories;
    }


    /**
     * Récupération d'une catégorie définie par son identifiant
     *
     * @param $idCategorie => Identifiant de la catégorie
     * @return mixed => Retourne la catégorie définie par l'identifiant
     * @throws Exception => Message d'erreur
     */
    public function getCategorie ($idCategorie) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT * FROM categories WHERE id = ?';

        // Récupération des catégories
        $recupCategorie = $this->executionRequete($reqSQL, array($idCategorie));


        // Retourne la catégorie demandée si il n'y a qu'un seul résultat, si non il génère un message d'erreur
        if ($recupCategorie->rowCount()) {
            return $recupCategorie->fetch();
        } else {
            throw new Exception("Aucune catégorie ne correspond à l'identifiant '$idCategorie'");
        }

    }

    /**
     * @param $idCategorie => Retourne le titre de la catégorie
     * @return mixed => Retourne le titre de la catégorie
     * @throws Exception => Message d'erreur
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

        // Renvoi un message d'erreur si aucune ligne est affectée
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la création de la catégorie");
        }

    }

    public function suppressionCategorie($idCategorie) {
        $reqSQL = 'DELETE FROM categories WHERE id = ?';

        $suppression = $this->executionRequete($reqSQL, array($idCategorie));

        // Vérification si la ligne est bien affectée
        $count = $suppression->rowCount();

        // Renvoi un message d'erreur si aucune ligne est affectée
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression de la catégorie");
        }

    }

    /**
     * Mise à jour de la catégorie
     *
     * @param $categorie
     * @param $idCategorie
     * @param $urlPres
     * @return int
     */
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