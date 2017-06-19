<?php

namespace Blog\Controleur;


use Blog\Framework\Controleur;

abstract class ControleurSecurise extends Controleur {

    public function executerAction($action) {

        if ($this->requete->getSession()->existeAttribut('idUtilisateur')) {
            parent::executerAction($action);
        } else {
            $this->redirection('connexion');
        }
    }
}