<?php
      
              if ( nbErreurs($tabErreurs) > 0 ) 
              {
 ?>
 <div class="container">
                <br>

 <?php             
                echo toStringErreurs($tabErreurs);
 ?>
 </div>            
 <?php               
              }
?>
