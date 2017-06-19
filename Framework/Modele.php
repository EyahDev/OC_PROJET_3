<?php

namespace Blog\Framework;

use PDO;


abstract class Modele {

    // Déclaration de la variable pour stocker l'accès à la base de données
    private static $bdd;


    /**
     * Prerequis => récuperation des informations grace à la fonction get de la classe Configuration
     * Récupère les elements de connexion à la base de données et créée l'accès
     *
     * @return PDO => Retourne l'accès à la base de données
     */
    private function getDatabase() {
        if (self::$bdd == null) {
            // Récupération des paramètres de configuration de la base de données
            $dsn = Configuration::get('dsn');
            $login = Configuration::get('login');
            $password = Configuration::get('password');

            // Création de la connexion
            self::$bdd = new PDO($dsn, $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$bdd;

    }

    /**
     * prerequis => être connecté à la base de données grace à la fonction getDatabase
     *
     * Execute une requête standard (query) ou préparé (prepare) et retourne le resultat dans une variable
     *
     * @param $reqSQL => Requête SQL pour la base de données
     * @param null $params => Tableau de parametres necessaire en cas d'une requête préparé
     * @return \PDOStatement => Retourne le résultat de la requête
     */
    protected function executionRequete($reqSQL, $params = null) {
        if ($params == null) {
            $resultat = self::getDatabase()->query($reqSQL);
        } else {
            $resultat = self::getDatabase()->prepare($reqSQL);
            $resultat->execute($params);
        }
        return $resultat;
    }
}
