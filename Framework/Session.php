<?php

namespace Blog\Framework;

use Exception;


class Session
{
    /**
     * Constructeur
     *
     * Démarre ou restaure la session
     */
    public function __construct() {
        session_start();
    }

    /**
     * Détruit la session en cours
     */
    public function destruction() {
        session_destroy();
    }

    /**
     * Ajoute un attribut à la session
     *
     * @param $nom => Le paramètre de la session
     * @param $valeur => la valeur du paramètre
     */
    public function setAttribut($nom, $valeur){
        $_SESSION[$nom] = $valeur;
    }

    /**
     * Vérification sur la session existe
     *
     * @param $nom => Paramètre de la session à vérifier
     * @return bool => Retourne vrai si le paramètre de la fonction existe
     */
    public function existeAttribut($nom) {
        return (isset($_SESSION[$nom]) && $_SESSION[$nom] != '');
    }

    /**
     * Récupération de la valeur du paramètre
     *
     * @param $nom => Paramètre de la session
     * @return mixed => Retourne la valeur du paramètre de la session
     * @throws Exception => Retourne un message d'erreur si nécessaire
     */
    public function getAttribut($nom) {
        if ($this->existeAttribut($nom)) {
            return $_SESSION[$nom];
        } else {
            throw new Exception("Attribut '$nom' absent de la session");
        }
    }

    /**
     * Récupération d'un message flash personnalisé
     *
     * @param $type => type de message flash
     * @return string => Retourne le message récupéré
     */
    public function getMessageFlash() {
        $messageFlash = '';

        if ($this->existeAttribut('erreur')) {
            $messageFlash = '<p id="flashErreur">' . $_SESSION['erreur'] . '</p>';
            unset($_SESSION['erreur']);
        } elseif ($this->existeAttribut('confirmation')) {
            $messageFlash = '<p id="flashConfirmation">' . $_SESSION['confirmation'] . '</p>';
            unset($_SESSION['confirmation']);
        }

        unset($_SESSION['flash']);

        return $messageFlash;
    }

    public function setMessageFlash($type, $message) {
        $_SESSION[$type] = $message;
    }

}