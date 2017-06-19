<?php

namespace Blog\Controleur;


use Blog\Framework\Controleur;
use Blog\Modele\Utilisateur;
use Exception;

class ControleurConnexion extends Controleur {

    // Déclaration des fonctions utiles au constructeur
    private $utilisateur;

    /**
     * ControleurConnexion constructor.
     */
    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }


    /**
     * Action par défaut du contrôleur
     */
    public function index() {
        // Récuperation du message flash
        $messageErreur = $this->requete->getSession()->getMessageFlash();

        if ($this->requete->getSession()->existeAttribut('idUtilisateur')) {
            $this->redirection('admin');
        } else {
            $this->genererVue(array(
                'messageErreur' => $messageErreur
            ));
        }

    }

    public function connecter() {
        // Vérification si le login et le mot de passe existent
        if ($this->requete->existeParametre('login') && $this->requete->existeParametre('password')) {

            // Récuperation des valeurs login & password
            $login = $this->requete->getParametre('login');
            $password = $this->requete->getParametre('password');

            // Vérfication si l'utilisateur existe dans la base de données
            if ($this->utilisateur->verifUtilisateur($login, $password)) {

                // Récuperation des informations de l'utilisateurs
                $utilisateur = $this->utilisateur->getUtilisateurs($login);

                // Définition des variables de sessions
                $this->requete->getSession()->setAttribut('idUtilisateur', $utilisateur['idUtilisateur']);
                $this->requete->getSession()->setAttribut('login', $utilisateur['login']);
                $this->requete->getSession()->setAttribut('auteur', $utilisateur['pseudo_auteur']);

                // Redirection sur la page d'administration
                $this->redirection('Admin');
            } else {
                // Définition d'un message flash
                $this->requete->getSession()->setMessageFlash('erreur', 'login ou mot de passe incorrects');

                //Redirection vers la page de connexion
                $this->redirection('connexion');
            }
        } else {
            throw new Exception("Action impossible login ou mot de passe non défini");
        }
    }

    public function deconnecter() {
        $this->requete->getSession()->destruction();
        $this->redirection('accueil');

    }
}