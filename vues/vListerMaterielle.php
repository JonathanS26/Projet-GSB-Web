
  <!-- Vue pour lister les fleurs
    ================================================== -->

<div class="container">

    <table class="table table-bordered table-striped table-condensed">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <thead>
        <tr>
          <th>Id</th>
          <th>Marque</th>
          <th>Dimension</th>
          <th>Modele</th>
          <th>Hauteur</th>
        </tr>
      </thead>
      <tbody>  
<?php
    $i = 0;
    while($i < count($lafleur))
    { 
 ?>     
        <tr>
            <td ><?php echo $lafleur[$i]['Id']?></td>
            <td><?php echo $lafleur[$i]['Marque']?></td>
            <td><?php echo $lafleur[$i]["Dimension"]?></td>
            <td ><?php echo $lafleur[$i]["Modele"]?></td>
            <td ><?php echo $lafleur[$i]["Hauteur"]?></td>            
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 
