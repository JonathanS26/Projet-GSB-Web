<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Ajouter"
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


// DEBUT du contr�leur rechercher.php 

if (count($_POST)==0)
{
    $etape = 1;
}
else
{
    $etape = 2;
    $uneRef=$_POST["ref"];
    $unNom=$_POST["nom"];
    $unPrenom=$_POST["prenom"];
    $uneAdresse=$_POST["adresse"];
    $uneCP=$_POST["cp"];
    $uneville=$_POST["ville"];
    $unsec_code=$_POST["sec_code"];
    $unlab_code=$_POST["lab_code"];
    modifier($uneRef, $unNom, $unPrenom, $uneAdresse, $uneCP, $uneville, $unsec_code, $unlab_code,$tabErreurs);
    // Message de r�ussite pour l'affichage
    if (nbErreurs($tabErreurs)==0)
    {
      $reussite = 1;
      $messageActionOk = "La fleur a �t� correctement modifi�e";
    }
  
}


// D�but de l'affichage (les vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");

if($etape==1)
{
   include($repVues."vModifierForm.php");
}
include($repVues."pied.php") ;
?>

