<?php

namespace Blog\Controleur;

use Blog\Framework\Controleur;

abstract class ControleurSecurise extends Controleur {

    /**
     * Exécute l'action du contrôleur
     *
     * @param $action => action du contrôleur
     */
    public function executerAction($action) {
        // Vérification si l'attribut existe
        if ($this->requete->getSession()->existeAttribut('idUtilisateur')) {
            // Exécute l'action
            parent::executerAction($action);
        } else {
            // Redirige vers la page de connexion
            $this->redirection('connexion');
        }
    }
}