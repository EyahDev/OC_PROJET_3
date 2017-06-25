<?php

namespace Blog\Controleur;

use Blog\Modele\Utilisateur;

class ControleurProfiladmin extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $utilisateur;

    /**
     * Instanciation des classes nécessaires
     *
     * ControleurProfiladmin constructor.
     */
    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    /**
     * Récupération des éléments pour la page d'administration de l'administrateur du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupération du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Récupération des éléments pour la page d'administration de l'utilisateur du blog et affichage de la vue
     */
    public function utilisateur() {
        // Récupération de l'identifiant de l'administrateur
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        // Récupération des informations de l'administrateur
        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur,
            'messageFlash' => $messageFlash
        ));
    }

    /**
     * Récupération des éléments pour la page d'administration du mot de passe du blog et affichage de la vue
     */
    public function password() {
        // Récuperation du message flash
        $messageErreur = $this->requete->getSession()->getMessageFlash();

        // Génération de la vue avec les paramètres
        $this->genererVue(array(
            'messageErreur' => $messageErreur
        ));
    }

    public function auteur() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur,
            'messageFlash' => $messageFlash
        ));
    }

    public function mail() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur,
            'messageFlash' => $messageFlash
        ));
    }

    public function aPropos() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        // Récupération du message flash
        $messageFlash = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur,
            'messageFlash' => $messageFlash
        ));
    }

    /**
     * Fonction pour la modification du mot de passe
     */
    public function modifierPassword() {
        // Récupération des informations pour le nouveau mot de passe
        $login = $this->requete->getSession()->getAttribut('login');
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');
        $ancienPassword = $this->requete->getParametre('ancienPassword');
        $nvPassword = $this->requete->getParametre('nvPassword');
        $nvPasswordVerif = $this->requete->getParametre('nvPasswordVerif');

        // Vérification si la combinaison login/ancien mot de passe existe
        if ($this->utilisateur->verifUtilisateur($login, $ancienPassword)) {

            // Vérification si le nouveau mot de passe et la vérification du nouveau mot de passe sont strictement égal
            if ($nvPassword === $nvPasswordVerif) {
                // Modification du mot de passe dans la base de données
                $this->utilisateur->setNewPassword($idUtilisateur, $nvPassword);

                // Définition d'un message flash de confirmation
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre mot de passe a bien été modifié.');

                // Redirection vers la page du profil admin
                $this->redirection('profiladmin');

            } else {
                // Définition d'un message flash d'erreur
                $this->requete->getSession()->setMessageFlash('erreur', 'Le nouveau mot de passe et le mot de passe de vérification ne correspondent pas, veuillez vérifier.');

                // Rédirection vers la page de modification du mot de passe pour un nouvel essai
                $this->redirection('profiladmin/password');
            }

        } else {
            // Définition du message flash d'erreur
            $this->requete->getSession()->setMessageFlash('erreur', 'L\'ancien mot de passe ne correpond pas, veuillez vérifier');

            // Rédirection vers la page de modification du mot de passe pour un nouvel essai
            $this->redirection('profiladmin/password');
        }
    }

    /**
     * Fonction pour la modification du nom d'utilisateur
     */
    public function modifierUtilisateur () {
        // Récupération des informations utilisateur
        $nvUtilisateur = $this->requete->getParametre('nvNomUtilisateur');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');

        if (empty($nvUtilisateur)) {
            // Définition d'un message flash d'erreur
            $this->requete->getSession()->setMessageFlash('erreur', 'Le nom d\'utilisateur est manquant');

            // Redirection vers la page de création d'un nouvel article
            $this->executerAction('utilisateur');
        } else {

            // Mise à jour du nom d'utilisateur dans la base de donnés
            $maj = $this->utilisateur->setNomUtilisateur($nvUtilisateur, $idUtilisateur);

            // mise à jour de la variable session
            $this->requete->getSession()->setAttribut('login', $nvUtilisateur);

            // Vérification si une modification a eu lieu ou non et génère un message flash en conséquence
            if ($maj == 1) {
                // Définition du message de confirmation avec modif
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nom d\'utilisateur a bien été modifié');
            } else {
                // Définition du message de confirmation sans modif
                $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
            }

            // Redirection vers la page du profil admin
            $this->redirection('profiladmin');
        }
    }

    /**
     * Fonction pour la modification de l'adresse mail
     */
    public function modifierMail () {
        // Récupération des informations du nouveau mail
        $nvMail = $this->requete->getParametre('nvMail');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');

        if (empty($nvMail)) {
            // Définition d'un message flash d'erreur
            $this->requete->getSession()->setMessageFlash('erreur', 'L\'adresse mail est manquante');

            // Redirection vers la page de création d'un nouvel article
            $this->executerAction('mail');
        } else {

            // Mise à jour de l'adresse mail dans la base de données
            $maj = $this->utilisateur->setMail($nvMail, $idUtilisateur);

            // Vérification si une modification a eu lieu ou non et génère un message flash en conséquence
            if ($maj == 1) {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre adresse mail a bien été modifié');
            } else {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
            }

            // Redirection vers la page du profil admin
            $this->redirection('profiladmin');
        }
    }


    /**
     * Fonction pour la modification du nom d'auteur
     */
    public function modifierAuteur () {
        // Récupération des informations du nom d'auteur
        $nvNomAuteur = $this->requete->getParametre('nvNomAuteur');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');

        if (empty($nvNomAuteur)) {
            // Définition d'un message flash d'erreur
            $this->requete->getSession()->setMessageFlash('erreur', 'Le nom d\'auteur est manquant');

            // Redirection vers la page de création d'un nouvel article
            $this->executerAction('auteur');
        } else {

            // Mise à jour dans la base de données
            $maj = $this->utilisateur->setNomAuteur($nvNomAuteur, $idUtilisateur);


            /// Vérification si une modification a eu lieu ou non et génère un message flash en conséquence
            if ($maj == 1) {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nom d\'auteur a bien été modifié');
            } else {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
            }

            // Redirection vers la page du profil admin
            $this->redirection('profiladmin');
        }
    }

    // Fonction pour la modification de la section a propos
    public function publierApropos () {
        // Récupération des informations d'a propos
        $aPropos = $this->requete->getParametre('contenuApropos');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');
        $urlAuteur =  $this->requete->getParametre('URLauteur');

        if (empty($aPropos)) {
            // Définition d'un message flash d'erreur
            $this->requete->getSession()->setMessageFlash('erreur', 'Le contenu de "A propos" est manquant');


            // Redirection vers la page de création d'un nouvel article
            $this->executerAction('aPropos');
        } else {

            // Création d'une image par défaut si la variable est vide
            if ($urlAuteur == '') {
                $urlAuteur = 'Contenu/img/default/user_default.png';
            }

            // Mise à jour de la section a propos dans la base de données
            $maj = $this->utilisateur->setAPropos($aPropos, $idUtilisateur, $urlAuteur);

            // Vérification si une modification a eu lieu ou non et génère un message flash en conséquence
            if ($maj == 1) {
                $this->requete->getSession()->setMessageFlash('confirmation', 'La section "A propos" a bien été publié');
            } else {
                $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
            }


            $this->redirection('profiladmin');
        }
    }
}