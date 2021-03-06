<?php

namespace Blog\Modele;

use Blog\Framework\Modele;
use Exception;


class Article extends Modele {

    /**
     * Récupération de tous les articles du blog
     *
     * @return array => Retourne les articles récuperés via l'exécution de la requête SQL
     */
    public function getArticles() {
        // Définition de la requête SQL
        $reqSQL =  'SELECT COUNT(c.article_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.article_date, "%d/%m/%Y à %H:%i") AS article_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles
                    FROM articles b LEFT JOIN commentaires c ON c.article_id = b.id
                    GROUP BY b.id
                    ORDER BY article_date DESC';
        // Récupération des articles en exécutant la requête
        $recupArticles = $this->executionRequete($reqSQL);

        // Retourne tous les articles récuperés
        return $recupArticles->fetchAll();
    }

    /**
     * Récupération de tous les articles du blog pour la page d'accueil
     *
     * @return array => Retourne les articles récuperés via l'exécution de la requête SQL
     */
    public function getArticlesAccueil() {
        // Définition de la requête SQL
        $reqSQL =  'SELECT COUNT(c.article_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.article_date, "%d/%m/%Y à %H:%i") AS article_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles
                    FROM articles b LEFT JOIN commentaires c ON c.article_id = b.id
                    GROUP BY b.id
                    ORDER BY article_date DESC
                    LIMIT 0, 12';
        // Récupération des articles en exécutant la requête
        $recupArticles = $this->executionRequete($reqSQL);

        // Retourne tous les articles récuperés
        return $recupArticles->fetchAll();
    }

    /**
     * Récupération de tous les articles du blog pour la partie admin
     *
     * @return \PDOStatement => Retourne les articles récuperés via l'exécution de la requête SQL
     */
    public function getArticlesAdmin() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.article_id) AS nbArticle, cat.categorie, b.id, b.titre, b.contenu, DATE_FORMAT(b.article_date, "%d/%m/%Y à %H:%i") AS article_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles
                    FROM articles b 
                    LEFT JOIN commentaires c ON c.article_id = b.id
                    INNER JOIN categories cat On b.categorie_id = cat.id
                    GROUP BY b.id
                    ORDER BY article_date DESC';

        // Récupération des articles en exécutant la requête
        $recupArticles = $this->executionRequete($reqSQL);

        // Retourne tous les articles récuperées
        return $recupArticles;
    }

    /**
     * Gestion de la pagination des catégories
     *
     * @param $idCategorie => identifiant de la catégorie
     * @return mixed => retourne le nombre d'articles de la catégorie
     */
    public function pagination($idCategorie) {
        $reqSQL = 'SELECT COUNT(*) as nbArticles FROM articles WHERE categorie_id = ?';

        $recupNBArticles = $this->executionRequete($reqSQL, array($idCategorie));

        return $recupNBArticles->fetch();
    }

    /**
     * Récupération des articles par catégorie en incluant le nombre à afficher par page
     *
     * @param $categorie
     * @param $pageCalcule
     * @param $articleParPage
     * @return \PDOStatement
     * @throws Exception
     */
    public function getArticlesCategorie($categorie, $pageCalcule, $articleParPage) {

        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.article_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.article_date, "%d/%m/%Y à %H:%i") AS article_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles, u.pseudo_auteur, cat.categorie
                    FROM articles b 
                    LEFT JOIN commentaires c ON c.article_id = b.id
                    INNER JOIN categories cat ON b.categorie_id = cat.id
                    INNER JOIN utilisateurs u ON b.auteur_id = u.id
                    WHERE b.categorie_id = :idCategorie
                    GROUP BY b.id                   
                    ORDER BY article_date DESC
                    LIMIT :pageCalcule, :articleParPage';

        // prépare la requête
        $recupArticle = $this->prepare($reqSQL);

        // Intégration des paramètres avec bindValue
        $recupArticle->bindValue(':idCategorie', $categorie,\PDO::PARAM_INT);
        $recupArticle->bindValue(':pageCalcule', $pageCalcule,\PDO::PARAM_INT);
        $recupArticle->bindValue(':articleParPage', $articleParPage,\PDO::PARAM_INT);

        $recupArticle->execute();

        // Retourne les article demandés si ils existent bien dans cette catégorie, si non génère un message d'erreur
        if ($recupArticle->rowCount()) {
            return $recupArticle;
        } else {
            throw new Exception("Aucune catégorie ne correspond à l'identifiant '$categorie'");
        }

    }

    /**
     * Récupération d'un seul article grâce à son id
     *
     * @param $idArticle => Identifiant du article demandé
     * @return mixed => Retourne le résultat de la recherche
     * @throws Exception => Génère un message d'erreur
     */
    public function getArticle($idArticle) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(c.article_id) AS nbCom, b.id, b.titre, b.contenu, DATE_FORMAT(b.article_date, "%d/%m/%Y à %H:%i") AS article_date, SUBSTR(b.contenu, 1, 350) AS extrait, b.categorie_id, b.url_img_pres, b.url_img_tuiles, u.pseudo_auteur, cat.categorie
                    FROM articles b 
                    LEFT JOIN commentaires c ON c.article_id = b.id
                    INNER JOIN categories cat ON b.categorie_id = cat.id
                    INNER JOIN utilisateurs u ON b.auteur_id = u.id
                    WHERE b.id = ?
                    GROUP BY b.id                   
                    ORDER BY article_date DESC';


        // Récupération de l'article demandé
        $recupArticle = $this->executionRequete($reqSQL, array($idArticle));

        // Retourne l'article demandé si il n'y a qu'un seul résultat, si non génère un message d'erreur
        if ($recupArticle->rowCount() == 1) {
            return $recupArticle->fetch();
        } else {
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
        }
    }


    public function getIDArticles() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT id, categorie_id FROM articles ORDER BY categorie_id';

        // Récupération de l'article demandé
        $recupID = $this->executionRequete($reqSQL);

        return $recupID->fetchAll();
    }

    /**
     * Compte tous les articles existant dans la base de données et retourne le résultat
     *
     * @return mixed =>Retourne le nombre d'articles existants dans la base de données
     */
    public function getNbArticles() {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(*) AS nbarticles FROM articles';

        // Exécution de la requête
        $resultat = $this->executionRequete($reqSQL);

        // Récupération du résultat et stockage dans une variable
        $ligne = $resultat->fetch();

        // Retourne le résultat
        return $ligne['nbArticles'];
    }

    public function getNbArticlesCategorie($idCategorie) {
        // Définition de la requête SQL
        $reqSQL = 'SELECT COUNT(*) AS nbarticles FROM articles WHERE categorie_id = ?';

        // Exécution de la requête
        $resultat = $this->executionRequete($reqSQL, array($idCategorie));

        // Récupération du résultat et stockage dans une variable
        $ligne = $resultat->fetch();

        // Retourne le résultat
        return $ligne['nbArticles'];
    }


    /**
     * Création d'un nouvel article dans la base de données
     *
     * @param $titre
     * @param $contenu
     * @param $categorie
     * @param $urlTuile
     * @param $urlPres
     * @param $auteurId
     * @return int
     * @throws Exception
     */
    public function setNvArticle($titre, $contenu, $categorie, $urlTuile, $urlPres, $auteurId){
        $reqSQL = 'INSERT INTO articles (titre, contenu, article_date, categorie_id, url_img_tuiles, url_img_pres, auteur_id) VALUES (:titre, :contenu, NOW(), :categorie, :urlTuile, :urlPres, :auteurId)';

        $ecriture = $this->executionRequete($reqSQL, array(
            ':titre' => $titre,
            ':contenu' => $contenu,
            ':categorie' => $categorie,
            ':urlTuile' => $urlTuile,
            ':urlPres' => $urlPres,
            ':auteurId' => $auteurId
        ));

        $count = $ecriture->rowCount();

        // Renvoie un message d'erreur si aucune ligne est affectée
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la publication du nouvel article");
        }

    }

    /**
     * Modification d'un article
     *
     * @param $idArticle => Identifiant de l'article à modifier
     * @param $titre => Titre modifié de l'article
     * @param $contenu => Contenu modifié de l'article
     * @throws Exception => Message d'erreur si la modification de l'article échoue
     * @return int => Nombre de ligne affectée par la maj
     */
    public function MAJArticle($idArticle, $titre, $contenu, $categorie, $urlTuile, $urlPres) {
        // Définition de la requête SQL
        $reqSQL = 'UPDATE articles SET titre = :titre, contenu = :contenu, categorie_id = :categorie, url_img_tuiles = :urlTuile, url_img_pres = :urlPres  WHERE id = :idArticle';

        // Exécution de la requête
        $maj = $this->executionRequete($reqSQL, array(
            ':idArticle' => $idArticle,
            ':titre' => $titre,
            ':contenu' => $contenu,
            ':categorie' =>$categorie,
            ':urlTuile' => $urlTuile,
            ':urlPres' => $urlPres
        ));

        // Retourne le nombre de ligne affectée
        return $maj->rowCount();

    }

    /**
     * Supprime l'article défini
     *
     * @param $idArticle => Identifiant l'article à supprimer
     * @return int => Retourne le nombre de ligne affectée par la requête
     * @throws Exception => erreur en cas d'échec de la suppression de l'article
     */
    public function supprArticle($idArticle) {
        // Définition de la requête SQL
        $reqSQL = 'DELETE FROM articles WHERE id = ?';

        // Exécution de la requête
        $suppression = $this->executionRequete($reqSQL, array($idArticle));

        // Vérification si la ligne est bien affectée
        $count = $suppression->rowCount();

        // Renvoi un message d'erreur si aucune ligne est affectée
        if ($count) {
            return $count;
        } else {
            throw new Exception("Il y a eu un problème avec la suppression de l'article");
        }

    }
}