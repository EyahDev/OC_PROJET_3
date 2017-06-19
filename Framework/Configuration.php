<?php

namespace Blog\Framework;

// Chargement des namespaces utiles au fonctionnement du framework
use Exception;

class Configuration {

    private static $parametres;

    /**
     * Recherche le fini dev ou prod.ini et renvoi les informations qu'il contient
     *
     * @return array|bool => Retourne un tableau de paramètres
     * @throws \Exception => Message d'erreur si aucun fichier trouvé
     */
    private static function getConfiguration() {
        if (self::$parametres == null) {
            $cheminfichier = "Config/prod.ini";
            if (!file_exists($cheminfichier)) {
                $cheminfichier = "Config/dev.ini";
            }
            if (!file_exists($cheminfichier)) {
                throw new Exception("Aucun fichier de configuration n'a été trouvé");
            } else {
                self::$parametres = parse_ini_file($cheminfichier);
            }

        }
        return self::$parametres;
    }

    /**
     * Recherche un paramètre dans les valeurs retournés par la fonction getConfiguration et renvoi sa valeur
     *
     * @param $nom => parametre à chercher
     * @param null $valeurParDefaut => si le paramètre n'a pas été trouvé, retourne null
     * @return null => Retourne la valeur trouvée
     */
    public static function get($nom, $valeurParDefaut = null) {
        if (isset(self::getConfiguration() [$nom])) {
            $valeur = self::getConfiguration() [$nom];

        } else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

}

