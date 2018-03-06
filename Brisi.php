<?php

include 'Konfiguracija/database.php';
 
try {
     
    
 
    if(isset($_GET['id'])){

        $id=$_GET['id'];

    }else{

        die('Zapis nije pronađen.') ; 
    }


    $upit = "DELETE FROM zaposlenici_mobiteli WHERE id = $id";
    $priprema = $con->prepare($upit);
   
     
    if($priprema->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Zapis nije obrisan.');
    }
}
 

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>