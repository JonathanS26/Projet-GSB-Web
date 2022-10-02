<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Rechercher"
 * @package default
 * @todo  RAS
 */
 
// Initialise les ressources n�cessaires au fonctionnement de l'application

  $repVues = './vues/';
  require("./include/_bdGestionDonnees.lib.php");
  require("./include/_gestionSession.lib.php");
  require("./include/_utilitairesEtGestionErreurs.lib.php");
  
  // d�marrage ou reprise de la session
  initSession();
  
  // initialement, aucune erreur ...
  $tabErreurs = array();
    

// DEBUT du contr�leur lister.php
 
  $lafleur = listerEmprunter();
  
  // Construction de la page Lister
  // pour l'affichage (appel des vues)
  include($repVues."entete.php") ;
  include($repVues."menu.php") ;
  include($repVues."vEmprunter.php");
  include($repVues."pied.php") ;
  ?>
    
