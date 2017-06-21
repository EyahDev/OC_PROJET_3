<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 14/06/2017
 * Time: 14:32
 */

namespace Blog\Controleur;


use Blog\Modele\Utilisateur;

class ControleurProfilAdmin extends ControleurSecurise {

    private $utilisateur;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    public function index() {
        // Récuperation du message de confirmation de publication
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'messageConfirmation' => $messageConfirmation
        ));
    }

    public function utilisateur() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur
        ));
    }

    public function password() {
        // Récuperation du message de confirmation de publication
        $messageErreur = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'messageErreur' => $messageErreur
        ));
    }

    public function modifierPassword() {
        $login = $this->requete->getSession()->getAttribut('login');
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');
        $ancienPassword = $this->requete->getParametre('ancienPassword');
        $nvPassword = $this->requete->getParametre('nvPassword');
        $nvPasswordVerif = $this->requete->getParametre('nvPasswordVerif');

        if ($this->utilisateur->verifUtilisateur($login, $ancienPassword)) {
            if ($nvPassword === $nvPasswordVerif) {
                $this->utilisateur->setNewPassword($idUtilisateur, $nvPassword);
                $this->requete->getSession()->setMessageFlash('confirmation', 'Votre mot de passe a bien été modifié.');
                $this->redirection('profiladmin');
            } else {
                $this->requete->getSession()->setMessageFlash('erreur', 'Le nouveau mot de passe et le mot de passe de vérification ne correspondent pas, veuillez vérifier.');
                $this->redirection('profiladmin/password');
            }
        } else {
            $this->requete->getSession()->setMessageFlash('erreur', 'L\'ancien mot de passe ne correpond pas, veuillez vérifier');
            $this->redirection('profiladmin/password');
        }
    }

    public function modifierUtilisateur () {
        $nvUtilisateur = $this->requete->getParametre('nvNomUtilisateur');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');

        $maj = $this->utilisateur->setNomUtilisateur($nvUtilisateur, $idUtilisateur);

        // mise à jour de la variable session
        $this->requete->getSession()->setAttribut('login', $nvUtilisateur);

        if ($maj == 1) {
            // Définition du message de confirmation avec modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nom d\'utilisateur a bien été modifié');
        } else {
            // Définition du message de confirmation sans modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        $this->redirection('profiladmin');
    }

    public function auteur() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur
        ));
    }

    public function modifierAuteur () {
        $nvNomAuteur = $this->requete->getParametre('nvNomAuteur');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');

        $maj = $this->utilisateur->setNomAuteur($nvNomAuteur, $idUtilisateur);

        if ($maj == 1) {
            // Définition du message de confirmation avec modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nom d\'auteur a bien été modifié');
        } else {
            // Définition du message de confirmation sans modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        $this->redirection('profiladmin');
    }

    public function aPropos() {
        $idUtilisateur = $this->requete->getSession()->getAttribut('idUtilisateur');

        $infoUtilisateur = $this->utilisateur->getInformations($idUtilisateur)->fetch();

        $this->genererVue(array(
            'infoUtilisateur' => $infoUtilisateur
        ));
    }

    public function publierApropos () {
        $aPropos = $this->requete->getParametre('contenuApropos');
        $idUtilisateur =  $this->requete->getParametre('idUtilisateur');
        $urlAuteur =  $this->requete->getParametre('URLauteur');

        if ($urlAuteur == '') {
            $urlAuteur = 'Contenu/img/default/user_default.png';
        }

        $maj = $this->utilisateur->setAPropos($aPropos, $idUtilisateur, $urlAuteur);

        if ($maj == 1) {
            // Définition du message de confirmation avec modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'La section "A propos" a bien été publié');
        } else {
            // Définition du message de confirmation sans modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        $this->redirection('profiladmin');
    }
}