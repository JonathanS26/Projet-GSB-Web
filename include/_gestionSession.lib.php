<?php
/** 
 * Regroupe les fonctions de gestion d'une session utilisateur.
 * @package default
 * @todo  RAS
 */

/** 
 * Démarre ou poursuit une session.                     
 *
 * @return void
 */
function initSession() {
    session_start();
}


/**
 * Conserve en variables session les informations du visiteur connecté
 * 
 * Conserve en variables session le nom et le mot de passe du visiteur connecté
 * @param string $nom  visiteur
 * @param string $mdp du visiteur
 * @param string $cat du visiteur
 * @return void    
 */
function connecter($nom, $mdp, $cat) {
    $_SESSION["nom"] = $nom;
    $_SESSION["mdp"] = $mdp;
    $_SESSION["cat"] = $cat;
    
}

/** 
 * Déconnecte le visiteur qui s'est identifié sur le site.                     
 *
 * @return void
 */
function deconnecter() {
    unset($_SESSION["nom"]);
    unset($_SESSION["mdp"]);
    unset($_SESSION["cat"]);
}

/** 
 * Vérifie si un client ou un admin s'est connecté sur le site.                     
 *
 * Retourne true si quelqu'un s'est connecté sur le site, false sinon. 
 * @return boolean 
 */
function estConnecte() {
    // actuellement il n'y a que les visiteurs qui se connectent
    return isset($_SESSION["nom"]);
}

/** 
 * Vérifie si un client s'est connecté sur le site.                     
 *
 * Retourne true si un client s'est connecté sur le site, false sinon. 
 * @return boolean échec ou succès
 */
function estVisiteurConnecte() 
{
    $connecte = false;
    if (isset($_SESSION["nom"]))
    {
        if ($_SESSION["cat"]=="client")
        {
           $connecte = true; 
        }
    }
    
    return $connecte;
}

/** 
 * Vérifie si un administrateur s'est connecté sur le site.                     
 *
 * Retourne true si un adminsitrateur s'est connecté sur le site, false sinon. 
 * @return boolean échec ou succès
 */
function estAdministrateurConnecte() 
{
    $connecte = false;
    if (isset($_SESSION["nom"]))
    {
        if ($_SESSION["cat"]=="admin")
        {
           $connecte = true; 
        }
    }    
    return $connecte;
}



?>