<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */


$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");
  
$unID=lireDonneePost("id", "");
$unNom=lireDonneePost("nom", "");
$unMdp=lireDonneePost("mdp", "");     //Mdp = Mot de pass
$unRole=lireDonneePost("role", "");


if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  ajouter($unID, $unNom, $unMdp, $unRole, $tabErreurs);
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
include($repVues."vAjouterVisi.php") ;
include($repVues."pied.php") ;
?>
  
