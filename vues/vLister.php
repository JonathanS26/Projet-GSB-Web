
  <!-- Vue pour lister les fleurs
    ================================================== -->
    <br>
<br>
<br>
<br>
<br>

<br>
<div class="container">

    <table class="table table-bordered table-striped table-condensed">
      <br>
      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Adresse</th>
          <th>code postal</th>
          <th>ville</th>
          <th>date embauche</th>
          <th>sec code</th>
          <th>lab code</th>
        </tr>
      </thead>
      <tbody>  
<?php
    $i = 0;
    while($i < count($lafleur))
    { 
 ?>     
        <tr>
            <td ><?php echo $lafleur[$i]['vis_matricule']?></td>
            <td><?php echo $lafleur[$i]['vis_nom']?></td>
            <td><?php echo $lafleur[$i]["vis_prenom"]?></td>
            <td ><?php echo $lafleur[$i]["vis_adresse"]?></td>
            <td><?php echo $lafleur[$i]["vis_cp"]?></td>
            <td ><?php echo $lafleur[$i]["vis_ville"]?></td>
            <td><?php echo $lafleur[$i]["vis_dateembauche"]?></td>
            <td><?php echo $lafleur[$i]["sec_code"]?></td>
            <td><?php echo $lafleur[$i]["lab_code"]?></td>
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 
