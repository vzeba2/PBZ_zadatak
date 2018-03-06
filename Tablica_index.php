<?php

include 'konfiguracija/database.php';
 
$upit = "SELECT id, ime, prezime,naziv_mobitela,tip_mobitela,limit_mobitel FROM zaposlenici_mobiteli ORDER BY id DESC";
$priprema = $con->prepare($upit);
$priprema->execute();
 

 
echo "<a href='Kreiraj.php' class='btn btn-primary kreiraj'>Kreiraj novi zapis</a>";

$broj = $priprema->rowCount();
if($broj>0){
 
   echo "<table class='table table-hover table-responsive table-bordered' id='table'>";
 
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Ime</th>";
        echo "<th>Prezime</th>";
        echo "<th>Naziv Mobitela</th>";
        echo "<th>Tip Mobitela</th>";
        echo "<th>Limit Mobitela</th>";
        echo "<th>Akcije</th>";
    echo "</tr>";
     
    while ($red = $priprema->fetch(PDO::FETCH_OBJ)){

    echo "<tr>";
        echo "<td>".$red->id."</td>";
        echo "<td>".$red->ime."</td>";
        echo "<td>".$red->prezime."</td>";
        echo "<td>".$red->naziv_mobitela."</td>";
        echo "<td>".$red->tip_mobitela."</td>";
        echo "<td>KN;".$red->limit_mobitel."</td>";
        echo "<td>";
             
        echo "<a href='editiraj.php?id=".$red->id."' class='btn btn-primary editiraj'>Promjena</a>";
        echo "<a href='#' onclick='obrisi_korisnika(".$red->id.");'  class='btn btn-danger'>Brisanje</a>";
        echo "</td>";
    echo "</tr>";
}
 
echo "</table>";



     
}
 
else{
    echo "<div class='alert alert-danger'>Nema zapisa.</div>";
}
?>