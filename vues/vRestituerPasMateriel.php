
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
          <th>dateEmprunter</th>
          <th>dateRestituer</th>
          <th>vis_matricule</th>
          <th>idMateriel </th>
     
        </tr>
      </thead>
      <tbody>  
<?php
    $i = 0;
    while($i < count($lafleur))
    { 
 ?>     
        <tr>
            <td><?php echo $lafleur[$i]['dateEmprunter']?></td>
            <td><?php echo $lafleur[$i]["dateRestituer"]?></td>
            <td ><?php echo $lafleur[$i]["vis_matricule"]?></td>
            <td><?php echo $lafleur[$i]["idMateriel"]?></td>
          
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 