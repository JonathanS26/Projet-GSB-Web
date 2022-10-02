<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Rechercher"
 * @package default
 * @todo  RAS
 */
 
  $repInclude = './include/';
  $repVues = './vues/';
  
  require($repInclude . "_init.inc.php");
 
  // Construction de la page Accueil
  // pour l'affichage (appel des vues) 
  include($repVues."entete.php") ;
  include($repVues."menu.php") ;
  include($repVues."vAccueil.php");
  include($repVues."pied.php") ;
?>
    
