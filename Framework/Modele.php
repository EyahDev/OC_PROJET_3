<?php

namespace Blog\Framework;

use PDO;


abstract class Modele
{

    // Déclaration de la variable pour stocker l'accès à la base de données
    private static $bdd;


    /**
     * Prérequis => récuperation des informations grâce à la fonction get de la classe Configuration
     * Récupère les éléments de connexion à la base de données et créée l'accès
     *
     * @return PDO => Retourne l'accès à la base de données
     */
    private function getDatabase()
    {
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
     * Prérequis => être connecté à la base de données grâce à la fonction getDatabase
     *
     * Exécute une requête standard (query) ou prépare (prepare) et retourne le résultat dans une variable
     *
     * @param $reqSQL => Requête SQL pour la base de données
     * @param null $params => Tableau de paramètres nécessaire en cas d'une requête préparée
     * @return \PDOStatement => Retourne le résultat de la requête
     */
    protected function executionRequete($reqSQL, $params = null)
    {
        if ($params == null) {
            $resultat = self::getDatabase()->query($reqSQL);
        } else {
            $resultat = self::getDatabase()->prepare($reqSQL);
            $resultat->execute($params);
        }
        return $resultat;
    }

    protected function prepare($reqSQL)
    {
        $resultat = self::getDatabase()->prepare($reqSQL);
        return $resultat;
    }
}