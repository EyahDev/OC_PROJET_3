<?php

namespace Blog\Framework;

use Exception;

class Requete {

    // Paramètre de la requête (ex : $_POST, $_GET)
    private $parametres;

    /**
     * Objet de la session
     *
     * @var Session
     */
    private $session;

    /**
     * Constructeur de la requête
     *
     * Définition du paramètre de la requête
     *
     * @param $paramètres
     */
    public function __construct($parametres) {
        $this->parametres = $parametres;
        $this->session = new Session();
    }

    /**
     * Récupération de l'objet de la session
     *
     * @return Session => Objet de la session
     */
    public function getSession() {
        return $this->session;
    }

    /**
     * Vérification si la valeur du paramètre existe dans la requête
     *
     * @param $nom => valeur du paramètre de la requête (ex : $_GET['billet'])
     * @return bool => Retourne vrai si la valeur du paramètre existe dans la requête
     */
    public function existeParametre($nom) {
        return (isset($this->parametres[$nom]) && $this->parametres[$nom] != '');
    }

    /**
     * prerequis => Vérification sur la valeur du paramètre existe grâce à la fonction existeParametre.
     *
     * Récupération de la valeur du paramètre
     *
     * @param $nom => valeur du paramètre
     * @return mixed => Retourne la valeur du paramètre
     * @throws Exception => Message d'erreur dans le cas où la valeur est absente
     */
    public function getParametre($nom) {
        if ($this->existeParametre($nom) == '') {
            $this->parametres[$nom] = '';
            return $this->parametres[$nom];
        } elseif ($this->existeParametre($nom)) {
            return $this->parametres[$nom];
        } else {
            throw new Exception("Paramètre '$nom' absent de la requête");
        }
    }
}