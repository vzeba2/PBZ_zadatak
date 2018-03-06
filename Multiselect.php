<?php

include 'konfiguracija/database.php';


$upit = "SELECT id,prezime  FROM zaposlenici_mobiteli ORDER BY id DESC";
$priprema = $con->prepare($upit);
$priprema->execute();
$output = "";


$output .= ' <select id="example-filterBehavior" name="framework[]" class="prvi" multiple="multiple">';

while($red= $priprema->fetch(PDO::FETCH_ASSOC))

	 {
  $output .=
  		' <option value="'.$red["id"].'">'.$red["prezime"].'</option>';


  	}

 $output .= ' </select>';



  echo $output;

  ?>