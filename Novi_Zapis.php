<?php
if($_POST){
 

    include 'Konfiguracija/database.php';
 
    try{
     
 
        $query = "INSERT INTO zaposlenici_mobiteli SET ime=:ime, prezime=:prezime, naziv_mobitela=:naziv_mob, tip_mobitela=:tip_mob,limit_mobitel=:limit_mob";
 
    
        $stmt = $con->prepare($query);
 
  
         $ime=htmlspecialchars(strip_tags($_POST['ime']));
        $prezime=htmlspecialchars(strip_tags($_POST['prezime']));
        $naziv_mob=htmlspecialchars(strip_tags($_POST['naziv_mobitela']));
        $tip_mob=htmlspecialchars(strip_tags($_POST['tip_mobitela']));
        $limit_mob=htmlspecialchars(strip_tags($_POST['limit_mobitel']));
 

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':naziv_mobitela', $naziv_mob);
        $stmt->bindParam(':tip_mob', $tip_mobitela);
        $stmt->bindParam(':limit_mob', $limit_mobitel);
        $stmt->bindParam(':id', $id);

         
    
      
         
      
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Zapis spremljen</div>";
        }else{
            echo "<div class='alert alert-danger'>Zapis nije spremljen</div>";
        }
         
    }
     
   
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>