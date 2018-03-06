  <?php
if($_POST){
 

    include 'Konfiguracija/database.php';
 
    try{
        $upit = "INSERT INTO zaposlenici_mobiteli SET ime=:ime, prezime=:prezime, naziv_mobitela=:naziv_mob, tip_mobitela=:tip_mob,limit_mobitel=:limit_mob";
        $priprema = $con->prepare($upit);
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $naziv_mob=$_POST['naziv_mobitela'];
        $tip_mob=$_POST['tip_mobitela']; 
        $limit_mob=$_POST['limit_mobitel'];  
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':prezime', $prezime);
        $priprema->bindParam(':naziv_mob', $naziv_mob);       
        $priprema->bindParam(':tip_mob', $tip_mob);
        $priprema->bindParam(':limit_mob', $limit_mob);

        

        if($priprema->execute()){
            echo "<div class='alert alert-success'>Zapis spremljen.</div>";
        }else{
            echo "<div class='alert alert-danger'>Zapis nije spremljen.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <title>Novo zaduženje</title>
      
    <link rel="stylesheet" href="Stilovi/bootstrap-3.3.7-dist/css/bootstrap.min.css" /> 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          
</head>
<body>
  
 <div class="container">
   
    <div class="page-header">
        <h1>Kreiraj zapis</h1>
    </div>

    <div id="NoviZapis">
       
            
    </div>       
      
<form id="validacija" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
           <td>Ime</td>
            <td><input type='text' name='ime'  class='form-control' /></td>
        </tr>
         <tr>
            <td>Prezime</td>
            <td><input type='text' name='prezime'  class='form-control' /></td>
        </tr>
         <tr>
            <td>Naziv mobitela</td>
            <td><input type='text' name='naziv_mobitela'  class='form-control' /></td>
        </tr>
         <tr>
            <td>Tip mobitela</td>
            <td><input type='text' name='tip_mobitela'  class='form-control' /></td>
        </tr>
     
        <tr>
            <td>Limit</td>
            <td><input type='text' name='limit_mobitel'  class='form-control'  /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Odustani</a>
            </td>
        </tr>
    </table>
</form>
          
    </div> 
      
<script src="Skripte/jquery-3.3.1.min.js"></script>
<script src="Stilovi/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> 
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->


<script type='text/javascript'>

function obrisi_korisnika(id){
     
    var odgovor = confirm('Jeste li sigurni da zelite obrisati korisnika?');
    if (odgovor){
         window.location = 'Brisi.php?id=' + id;
    } 
}

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

