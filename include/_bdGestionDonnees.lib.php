<?php

// FONCTIONs POUR L'ACCES A LA BASE DE DONNEES
// Ajouter en t�tes 
// Voir : jeu de caract�res � la connection

/** 
 * Se connecte au serveur de donn�es                     
 * Se connecte au serveur de donn�es � partir de valeurs
 * pr�d�finies de connexion (h�te, compte utilisateur et mot de passe). 
 * Retourne l'identifiant de connexion si succ�s obtenu, le bool�en false 
 * si probl�me de connexion.
 * @return resource identifiant de connexion
 */
function connecterServeurBD() 
{
    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_port='3306';
    $PARAM_nom_bd='gsbVisiteur2'; // le nom de votre base de donn�es
    $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe='root'; // mot de passe de l'utilisateur pour se connecter

    $connect = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
 
    return $connect;
}

function lister()
{
    $connexion = connecterServeurBD();
   
    $requete="select vis_matricule, vis_nom, vis_prenom, vis_adresse, vis_cp, vis_ville, vis_dateembauche, sec_code, lab_code from visiteur";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $fleur[$i]['vis_matricule']=$ligne['vis_matricule'];
        $fleur[$i]['vis_nom']=$ligne['vis_nom'];
        $fleur[$i]['vis_prenom']=$ligne['vis_prenom'];
        $fleur[$i]['vis_adresse']=$ligne['vis_adresse'];
        $fleur[$i]['vis_cp']=$ligne['vis_cp'];
        $fleur[$i]['vis_ville']=$ligne['vis_ville'];
        $fleur[$i]['vis_dateembauche']=$ligne['vis_dateembauche'];
        $fleur[$i]['sec_code']=$ligne['sec_code'];
        $fleur[$i]['lab_code']=$ligne['lab_code'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}

function listerMaterielle()
{
    $connexion = connecterServeurBD();
   
    $requete="select Id, Marque, Dimension, Modele, Hauteur from materiel";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $fleur[$i]['Id']=$ligne['Id'];
        $fleur[$i]['Marque']=$ligne['Marque'];
        $fleur[$i]['Dimension']=$ligne['Dimension'];
        $fleur[$i]['Modele']=$ligne['Modele'];
        $fleur[$i]['Hauteur']=$ligne['Hauteur'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}

function ajouterMaterielle($ref, $marque, $dimension, $modele, $hauteur, &$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
  // Cr�er la requ�te d'ajout 
  $requete="insert into materiel"
  ."(id, marque, dimension, modele, hauteur) values ('"
  .$ref."','"
  .$marque."','"
  .$dimension."','"
  .$modele."','"
  .$hauteur."');";
  
  // Lancer la requ�te d'ajout 
  $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
  // Si la requ�te a r�ussi
  if ($ok)
  {
    $message = "La fleur a �t� correctement ajout�e";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, l'ajout de la fleur a �chou� !!!";
    ajouterErreur($tabErr, $message);
  } 

}
                                                                  
function ajouterVisi($id, $nom, $mdp, $role, &$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
    
    // V�rifier que la r�f�rence saisie n'existe pas d�ja
    $requete="select * from visiteur";
    $requete=$requete." where idVisiteur = '".$id."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {
      $message="Echec de l'ajout : l'ID existe déjà !";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      // Cr�er la requ�te d'ajout 
       $requete="insert into visiteur"
       ."(idVisiteur,nomVisiteur,mdpVisiteur,roleVisiteur) values ('"
       .$id."','"
       .$nom."',"
       .$mdp."','"
       .$role."');";
       
        // Lancer la requète d'ajout 
        $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requ�te a r�ussi
        if ($ok)
        {
          $message = "Le Visiteur a été correctement ajoutée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, l'ajout du visiteur a échoué !!!";
          ajouterErreur($tabErr, $message);
        } 

    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "Problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}


function rechercher($des)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
   
    $requete="select vis_matricule, vis_nom, vis_prenom, vis_adresse, vis_cp, vis_ville, vis_dateembauche, sec_code, lab_code from visiteur";
      $requete=$requete." where vis_nom='".$des."';";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
      $fleur[$i]['vis_matricule']=$ligne['vis_matricule'];
      $fleur[$i]['vis_nom']=$ligne['vis_nom'];
      $fleur[$i]['vis_prenom']=$ligne['vis_prenom'];
      $fleur[$i]['vis_adresse']=$ligne['vis_adresse'];
      $fleur[$i]['vis_cp']=$ligne['vis_cp'];
      $fleur[$i]['vis_ville']=$ligne['vis_ville'];
      $fleur[$i]['vis_dateembauche']=$ligne['vis_dateembauche'];
      $fleur[$i]['sec_code']=$ligne['sec_code'];
      $fleur[$i]['lab_code']=$ligne['lab_code'];;
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}
function rechercherMaterielle($des)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
   
    $requete="select Id, Marque, Dimension, Modele from materiel";
      $requete=$requete." where Modele='".$des."';";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
      $fleur[$i]['Id']=$ligne['Id'];
        $fleur[$i]['Marque']=$ligne['Marque'];
        $fleur[$i]['Dimension']=$ligne['Dimension'];
        $fleur[$i]['Modele']=$ligne['Modele'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}

function supprimer($ref, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
          
    $requete="delete from visiteur";
    $requete=$requete." where vis_matricule='".$ref."';";
    
    // Lancer la requ�te supprimer
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
      
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "La fleur a �t� correctement supprim�e";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      $message = "Attention, la suppression de la fleur a �chou� !!!";
      ajouterErreur($tabErr, $message);
    }      
}

function supprimerMaterielle($ref, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
          
    $requete="delete from materiel";
    $requete=$requete." where id='".$ref."';";
    
    // Lancer la requ�te supprimer
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
      
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "La fleur a �t� correctement supprim�e";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      $message = "Attention, la suppression de la fleur a �chou� !!!";
      ajouterErreur($tabErr, $message);
    }      
}

function inscription($unNom, $unMdp, $unMdpConf, $uneCat, &$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    if($unMdp != $unMdpConf)
    {
      $message = "les deux mots de passe sont different";
      ajouterErreur($tabErr, $message);
    }
    else
    {
       // Cr�er la requ�te d'ajout 
      $requete="insert into utilisateur"
      ."(nom,mdp,cat) values ('"
      .$unNom."','"
      .$unMdp."','"
      .$uneCat."');";
  
      // Lancer la requ�te d'ajout 
      $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
  // Si la requ�te a r�ussi
      if ($ok)
      {
       $message = "L'utilisateur a �t� correctement ajout�e";
       ajouterErreur($tabErr, $message);
       }
      else
      {
       $message = "Attention, l'ajout de l'utilisateur a �chou� !!!";
        ajouterErreur($tabErr, $message);
      } 
    }
 

}


function modifier($ref, $nom, $prenom, $adresse, $cp, $ville, $sec_code, $lab_code,&$tabErr)
{
  
    // Ouvrir une connexion au serveur mysql en s'identifiant
    $connexion = connecterServeurBD();
    
    // V�rifier que la r�f�rence saisie n'existe pas d�ja
    $requete="select * from visiteur";
    $requete=$requete." where vis_matricule = '".$ref."';";              
   
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    //$jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    // Cr�er la requ�te de modification 
  
    $requete= "UPDATE visiteur SET vis_adresse = '$adresse',
    `vis_nom` = '$nom',
    `vis_prenom` = '$prenom',
    `vis_cp` = '$cp',
    `vis_ville` = '$ville',
    `sec_code`= '$sec_code',
    `lab_code` = '$lab_code' WHERE `vis_matricule`='$ref';";
         
    // Lancer la requ�te d'ajout 
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
      
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "La fleur a �t� correctement modifi�";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      $message = "Attention, la modification de la fleur a �chou� !!!";
      ajouterErreur($tabErr, $message);
    } 
}

function modifierMaterielle($ref, $marque, $dimension, $modele,&$tabErr)
{
  
    // Ouvrir une connexion au serveur mysql en s'identifiant
    $connexion = connecterServeurBD();
    
    // V�rifier que la r�f�rence saisie n'existe pas d�ja
    $requete="select * from materiel";
    $requete=$requete." where id = '".$ref."';";              
   
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    //$jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    // Cr�er la requ�te de modification 
  
    $requete= "UPDATE materiel SET marque = '$marque',
    `dimension` = '$dimension',
    `modele` = '$modele'
     WHERE `id`='$ref';";
         
    // Lancer la requ�te d'ajout 
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
      
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "La fleur a �t� correctement modifi�";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      $message = "Attention, la modification de la fleur a �chou� !!!";
      ajouterErreur($tabErr, $message);
    } 
}


function rechercherUtilisateur($log, $psw, &$tabErr)
{
    $connexion = connecterServeurBD();
      
    $requete="select * from utilisateur";
      $requete=$requete." where nom='".$log."' and mdp ='".$psw."';";
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    // Initialisationd e la cat�gorie trouv�e � : "aucune"
    $cat = "nulle";
    
    $ligne = $jeuResultat->fetch();
    
    // Si un utilisateur est trouv�, on initialise une variable cat avec la cat�gorie de cet utilisateur trouv�e dans la table utilisateur
    if ($ligne)
    {
        $cat = $ligne['cat'];
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $cat;
}
function listerEmprunter()
{
    $connexion = connecterServeurBD();
   
    $requete="select dateEmprunter, dateRestituer, vis_matricule, idMateriel from emprunter where dateRestituer is not null";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $fleur[$i]['dateEmprunter']=$ligne['dateEmprunter'];
        $fleur[$i]['dateRestituer']=$ligne['dateRestituer'];
        $fleur[$i]['vis_matricule']=$ligne['vis_matricule'];
        $fleur[$i]['idMateriel']=$ligne['idMateriel'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}
function listerPasRestituer()
{
    $connexion = connecterServeurBD();
   
    $requete="select dateEmprunter, dateRestituer, vis_matricule, idMateriel from emprunter where dateRestituer is null";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $fleur[$i]['dateEmprunter']=$ligne['dateEmprunter'];
        $fleur[$i]['dateRestituer']=$ligne['dateRestituer'];
        $fleur[$i]['vis_matricule']=$ligne['vis_matricule'];
        $fleur[$i]['idMateriel']=$ligne['idMateriel'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $fleur;
}

function ajouterEmprunt($dateEmprunter, $vis_matricule, $idMateriel,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
  $requete="select * from emprunter";
  $requete=$requete." where idMateriel = '".$idMateriel."';";   
  // Cr�er la requ�te d'ajout 
  $requete="insert into emprunter"
  ."(dateEmprunter, vis_matricule, idMateriel) values ('"
  .$dateEmprunter."','"
  .$vis_matricule."','"
  .$idMateriel."');";
  
  // Lancer la requ�te d'ajout 
  $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
  // Si la requ�te a r�ussi
  if ($ok)
  {
    $message = "L'emprunt a �t� correctement ajout�e";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, l'ajout de l'emprunt a �chou� !!!";
    ajouterErreur($tabErr, $message);
  } 

}
function ajouterRestituer($dateEmprunter, $dateRestituer, $vis_matricule, $idMateriel,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  $requete="select dateEmprunter, vis_matricule, idMateriel from emprunter";
  $requete=$requete." where vis_matricule = '".$vis_matricule."' and dateRestituer is null;";   
  // Cr�er la requ�te d'ajout 
  $requete="insert into emprunter"
  ."(dateRestituer) values ('"
  .$dateRestituer."');";          
 
  $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant


  
  // Si la requ�te a r�ussi
  if ($ok)
  {
    $message = "Le matériel a �t� correctement restituer";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, la réstitution de l'emprunt a �chou� !!!";
    ajouterErreur($tabErr, $message);
  } 

}
?>
