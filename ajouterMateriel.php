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
    

// DEBUT du contr�leur ajouter.php

if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  $uneRef=$_POST["ref"];
  $uneMarque=$_POST["marque"];
  $uneDimension=$_POST["dimension"];
  $unModele=$_POST["modele"];
  $uneHauteur=$_POST["hauteur"];
  ajouterMaterielle($uneRef, $uneMarque, $uneDimension, $unModele, $uneHauteur, $tabErreurs);
}

// D�but de l'affichage (les vues)

include($repVues."entete.php");
include($repVues."menu.php");
include($repVues."erreur.php");
include($repVues."vAjouterMaterielle.php");
include($repVues."pied.php");
?>
  
