 <?php
if(isset($_GET['id'])){

$id=$_GET['id'];

}else{

   die('Zapis nije pronađen.') ; 
}

 
include 'Konfiguracija/database.php';
 

try {

    $query = "SELECT id, ime, prezime,naziv_mobitela,tip_mobitela,limit_mobitel FROM zaposlenici_mobiteli WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $ime = $row['ime'];
    $prezime = $row['prezime'];
    $naziv_mob = $row['naziv_mobitela'];
    $tip_mob = $row['tip_mobitela'];
    $limit_mob = $row['limit_mobitel'];
}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>

<?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE zaposlenici_mobiteli 
                    SET ime=:ime, prezime=:prezime, naziv_mobitela=:naziv_mob, tip_mobitela=:tip_mob,limit_mobitel=:limit_mob 
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $ime=htmlspecialchars(strip_tags($_POST['ime']));
        $prezime=htmlspecialchars(strip_tags($_POST['prezime']));
        $naziv_mob=htmlspecialchars(strip_tags($_POST['naziv_mobitela']));
        $tip_mob=htmlspecialchars(strip_tags($_POST['tip_mobitela']));
        $limit_mob=htmlspecialchars(strip_tags($_POST['limit_mobitel']));
 
        // bind the parameters

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':naziv_mob', $naziv_mob);
        $stmt->bindParam(':tip_mob', $tip_mob);
        $stmt->bindParam(':limit_mob', $limit_mob);
        $stmt->bindParam(':id', $id);

         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Zapis promijenjen</div>";
        }else{
            echo "<div class='alert alert-danger'>Zapis nije promjenjen</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <title>Izmjena Podataka</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Izmjena zapisa</h1>
        </div>


 <form id="validacija" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Ime</td>
            <td><input type='text' name='ime' value="<?php echo htmlspecialchars($ime, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Prezime</td>
            <td><input type='text' name='prezime' value="<?php echo htmlspecialchars($prezime, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Naziv mobitela</td>
            <td><input type='text' name='naziv_mobitela' value="<?php echo htmlspecialchars($naziv_mob, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Tip mobitela</td>
            <td><input type='text' name='tip_mobitela' value="<?php echo htmlspecialchars($tip_mob, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
     
        <tr>
            <td>Limit</td>
            <td><input type='text' name='limit_mobitel' value="<?php echo htmlspecialchars($limit_mob, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Sacuvaj promjene' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Povratak</a>
            </td>
        </tr>
    </table>
</form>
        <!-- HTML form to update record will be here -->
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> 




<script type='text/javascript'>


$(document).ready(function() {

   $('#validacija').validate({ // initialize the plugin
        rules: {
            ime: {
                required: true,
                            },
            prezime: {
                required: true,
              
            },
             naziv_mobitela: {
                required: true,
                minlength: 2,
                
            },
             tip_mobitela: {
                required: true,
                minlength: 2,
                
            },
            limit_mobitel: {
                required: true,
                digits: true
                
            }
        }
    });


});
</script>

 
</body>
</html>