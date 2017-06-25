<?php

namespace Blog\Controleur;


use Blog\Framework\Controleur;
use Blog\Modele\Utilisateur;
use Exception;

class ControleurConnexion extends Controleur {

    // Déclaration des variables pour le constructeur
    private $utilisateur;

    /**
     * Instanciation des classes nécessaires
     *
     * ControleurConnexion constructor.
     */
    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }


    /**
     * Récupération des éléments pour la page de connexion du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupération du message flash
        $messageErreur = $this->requete->getSession()->getMessageFlash();

        // Redirection automatique sur la page d'administration si l'administrateur est déjà connecté ou non
        if ($this->requete->getSession()->existeAttribut('idUtilisateur')) {
            $this->redirection('admin');
        } else {
            $this->genererVue(array(
                'messageErreur' => $messageErreur
            ));
        }

    }

    /**
     * Fonction pour la connexion à la partie d'administration
     *
     * @throws Exception => message d'erreur dans le cas ou le login et/ou le password ne sont pas définis
     */
    public function connecter() {
        // Vérification si le login et le mot de passe existent en tant que paramètres
        if ($this->requete->existeParametre('login') && $this->requete->existeParametre('password')) {

            // Récupération des valeurs login & password
            $login = $this->requete->getParametre('login');
            $password = $this->requete->getParametre('password');

            // Vérification si l'utilisateur existe dans la base de données
            if ($this->utilisateur->verifUtilisateur($login, $password)) {

                // Récupération des informations de l'utilisateur
                $utilisateur = $this->utilisateur->getUtilisateurs($login);

                // Définition des variables de sessions
                $this->requete->getSession()->setAttribut('idUtilisateur', $utilisateur['idUtilisateur']);
                $this->requete->getSession()->setAttribut('login', $utilisateur['login']);

                // Redirection sur la page d'administration
                $this->redirection('Admin');
            } else {

                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le login et/ou le mot de passe sont incorrects');

                //Redirection vers la page de connexion
                $this->redirection('connexion');
            }
        } else {
            // message d'erreur dans le cas ou le login et/ou le password ne sont pas définis
            throw new Exception("Action impossible login ou mot de passe non défini");
        }
    }

    /**
     * Fonction de déconnexion de l'interface d'administration
     */
    public function deconnecter() {
        // Destruction de la session
        $this->requete->getSession()->destruction();

        // Redirection vers la page d'accueil
        $this->redirection('accueil');
    }
}