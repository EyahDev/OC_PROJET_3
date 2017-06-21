<?php


namespace Blog\Modele;


use Blog\Framework\Modele;
use Exception;

class Utilisateur extends Modele {


    /**
     * Vérification si l'utilisateur existe et que le mot de passe correspond au hashage dans la base de données
     *
     * @param $login => Le login à rechercher
     * @param $password => le password à rechercher
     * @return bool => Retourne vrai si la combinaison utilisateur/password existe
     */
    public function verifUtilisateur($login, $password) {
        $reSQL = 'SELECT password FROM utilisateurs WHERE login = ?';

        // Execution de la rêquete pass
        $pass = $this->executionRequete($reSQL, array($login))->fetch();

        // Vérification si le mot de passe hashé dans la bdd correspond
        $verifPassword = password_verify($password, $pass['password']);

        // Retourne vrai si la password hashé correpond à celui de la base de données
        if ($verifPassword) {
            return $verifPassword;
        }
    }

    /**
     * Récupération des informations de l'utilisateur
     *
     * @param $login => Login de l'utilisateur
     * @param $password => Password de l'utilisateur
     * @return mixed => Retourne les informations récuperer
     * @throws Exception => Message d'erreur si les identifiants sont incorrect
     */
    public function getUtilisateurs($login) {
        // Défintion de la requête SQL
        $reqSQL = 'SELECT id AS idUtilisateur, login, password, pseudo_auteur FROM utilisateurs WHERE login =  ?';

        // Exécution de la requête
        $utilisateur = $this->executionRequete($reqSQL, array($login));

        // Si il y a bien une ligne qui existe dans la base de données, retourne les informations si non leve une erreur
        if ($utilisateur->rowCount() == 1) {
            return $utilisateur->fetch();
        } else {
            throw new Exception("Aucun utilisateur ne correspond aux identifiants");
        }
    }

    public function getInformations($idUtilisateur) {
        // Défintion de la requête SQL
        $reqSQL = 'SELECT * FROM utilisateurs WHERE id = ?';

        // Exécution de la requête
        $utilisateur = $this->executionRequete($reqSQL, array($idUtilisateur));

        return $utilisateur;

    }

    public function setNewPassword($idUtilisateur, $nvPassword) {
        // Définition de la requête
        $reqSQL = 'UPDATE utilisateurs SET password = :nvPassword WHERE id = :idUtilisateur;';

        // hashage du mot de passe avant la mise à jour dans la base de données
        $passwordHash = password_hash($nvPassword, PASSWORD_BCRYPT);

        $MAJpassword = $this->executionRequete($reqSQL, array(
            ':nvPassword' => $passwordHash,
            ':idUtilisateur' => $idUtilisateur
        ));

        $count =  $MAJpassword->rowCount() == 1;

        if ($count) {
           return $count;
        } else {
           throw new Exception("Il y a eu un problème avec la modification du mot de passe");
        }
    }

    public function setNomUtilisateur($nvUtilisateur, $idUtilisateur) {
        // Définition de la requête
        $reqSQL = 'UPDATE utilisateurs SET login = :nvLogin WHERE id = :idUtilisateur;';


        $MAJuser = $this->executionRequete($reqSQL, array(
            ':nvLogin' => $nvUtilisateur,
            ':idUtilisateur' => $idUtilisateur
        ));

        return $MAJuser->rowCount();
    }

    public function setNomAuteur($nvAuteur, $idUtilisateur) {
        // Définition de la requête
        $reqSQL = 'UPDATE utilisateurs SET pseudo_auteur = :nvAuteur WHERE id = :idUtilisateur;';


        $MAJauteur = $this->executionRequete($reqSQL, array(
            ':nvAuteur' => $nvAuteur,
            ':idUtilisateur' => $idUtilisateur
        ));

        return $MAJauteur->rowCount();

    }

    public function setApropos($aPropos, $idUtilisateur, $urlAuteur) {
        // Définition de la requête
        $reqSQL = 'UPDATE utilisateurs SET apropos = :aPropos, url_img_apropos = :urlAuteur WHERE id = :idUtilisateur';


        $MAJaPropos = $this->executionRequete($reqSQL, array(
            ':aPropos' => $aPropos,
            ':idUtilisateur' => $idUtilisateur,
            ':urlAuteur' => $urlAuteur
        ));

        return $MAJaPropos->rowCount();

    }

    public function getAPropos() {
        // Défintion de la requête SQL
        $reqSQL = 'SELECT apropos, url_img_apropos FROM utilisateurs';

        // Exécution de la requête
        $utilisateur = $this->executionRequete($reqSQL);

        return $utilisateur->fetch();

    }


}