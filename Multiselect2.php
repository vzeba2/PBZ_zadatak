<?php

include 'konfiguracija/database.php';


$upit = "SELECT id,naziv_mobitela FROM zaposlenici_mobiteli ORDER BY id DESC";
$priprema = $con->prepare($upit);
$priprema->execute();
$output = "";


$output .= ' <select id="example-filterBehavior" class="drugi" name="framework[]" multiple="multiple">';

while($red= $priprema->fetch(PDO::FETCH_ASSOC))

	 {
  $output .=
  		' <option value="'.$red["id"].'">'.$red["naziv_mobitela"].'</option>';


  	}

 $output .= ' </select>';



  echo $output;

  ?>