<script type="text/javascript">
//<![CDATA[

function valider(){
 frm=document.forms['formAjout'];
  // si le prix est positif
  if(frm.elements['hauteur'].value >= 0 && frm.elements['hauteur'].value <= 10) {
    // les données sont ok, on peut envoyer le formulaire    
    return true;
  }
  else {
    // sinon on affiche un message
    alert("La hauteur doit être compris entre 0 et 10 !");
    // et on indique de ne pas envoyer le formulaire
    return false;
  }
}
//]]>
</script>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!--Vue pour la saisie des informations dans un formulaire!-->

<div class="container">

<form name="formAjout" action="" method="post" onSubmit="return valider()">
  <fieldset>
    <legend>Entrez les donnees sur l'empreint à ajouter </legend>
    <label> Id : </label> <input type="text" placeholder="Entrer la reference à"name="ref" size="10" /><br />
    <label>Marque :</label> <input type="text" name="marque" size="20" /><br />
    <label>Dimension:</label> <input type="text" name="dimension" size="10" /><br />
    <label>Modele:</label> <input type="text" name="modele" size="10" /><br />
    <label>Hauteur:</label> <input type="text" name="hauteur" size="10" /><br />   
   
  </fieldset>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
  <button type="reset" class="btn">Annuler</button>
  </p>
</form>
</div>


