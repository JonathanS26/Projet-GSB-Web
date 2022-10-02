<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
  $repVues = './vues/';
  require("./include/_bdGestionDonnees.lib.php");
  require("./include/_gestionSession.lib.php");
  require("./include/_utilitairesEtGestionErreurs.lib.php");
  // d�marrage ou reprise de la session
  initSession();
  // initialement, aucune erreur ...
  $tabErreurs = array();
    

 

if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  $uneDes=$_POST["des"];
  
  $lafleur=rechercherMaterielle($uneDes);
  if (count($lafleur) == 0)
  {
    $message = "Aucune fleur n'a �t� trouv�e !";
    ajouterErreur($tabErreurs, $message);
  }
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
if ($etape==1)
{
  include($repVues."vRechercherMaterielle.php"); ;
}
else
{
  include($repVues."vListerMaterielle.php") ;
}
include($repVues."pied.php") ;
?>
  

