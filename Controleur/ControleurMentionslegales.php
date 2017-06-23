<?php

namespace Blog\Controleur;

use Blog\Framework\Controleur;

class ControleurMentionslegales extends Controleur {

    /**
     * Affichage de la vue
     */
    public function index() {
        // Création d'un cookie de session pour la nav
        $this->requete->getSession()->setAttribut('in', 'Mentionslegales');
        $this->genererVue();
    }

}