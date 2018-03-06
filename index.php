<?php
 
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
else{
  $action = "";
}

 
if($action=='deleted'){
    echo "<div class='alert alert-success'>Korisnik je obrisan</div>";
}

?>


<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<head>
    <title>Zaposlenici - mobiteli</title>
     
    <link rel="stylesheet" href="Stilovi/bootstrap-3.3.7-dist/css/bootstrap.min.css" /> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"> 
    <link rel="stylesheet" href="Stilovi/bootstrapmultiselect/dist/css/bootstrap-multiselect.css"> 

         
    <style>
    .kreiraj { margin-bottom:10px; }
    .editiraj{ margin-right:10px; }
    .mt0{ margin-top:0; }

     body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }


    </style>
 
</head>
<body>
 
   
    <div class="container">  
        <div class="page-header">
            <h1>Popis djelatnika</h1>
        </div>
        <div id="Tablica">
            <!-- Ispis Tablica_index.php-->

        
        </div>  

        <div id="Trazilica_prikaz">
            <!-- Ispis Tablica_index.php-->

        
        </div> 

         <div class="page-header">
         <h4>Trazilica</h4>

        <form method="post" id="framework_form">
          <div class="form-group">
         <div class="row">
  
  <div class="col-sm-5" id="multisel">Po prezimenu</div>
  <div class="col-sm-5" id="multisel2">Po nazivu mobitela: </div>
  <div class="col-sm-2"><input type="submit" class="btn btn-info" id="dugme" name="submit" value="Submit" /></div>
  
</div>

    </div>
   </form>


    </div> 
     
<script src="Skripte/jquery-3.3.1.min.js"></script>
<script src="Stilovi/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="Stilovi/bootstrapmultiselect/dist/js/bootstrap-multiselect.js"></script>

<script type='text/javascript'>

function obrisi_korisnika(id){
     
    var odgovor = confirm('Jeste li sigurni da zelite obrisati korisnika?');
    if (odgovor){
         window.location = 'Brisi.php?id=' + id;
    } 
}


$.ajax({
       url: 'Multiselect.php',
       success: function(data) {
          $("#multisel").append(data);
       }
    });

$.ajax({
       url: 'Multiselect2.php',
       success: function(data) {
          $("#multisel2").append(data);
       }
    });


$(document).ready(function() {

    $.ajax({
       url: 'Tablica_index.php',
       success: function(data) {
          $("#Tablica").append(data);
       }
    });





/*     $.ajax({
       url: 'Multiselect.php',
       success: function(data) {
          $("#multisel").append(data);
       }
    });

*/
  

$('#example-filterBehavior.prvi').multiselect({
            enableFiltering: true,
            filterBehavior: 'value',
            nonSelectedText: 'Select Framework',
            enableCaseInsensitiveFiltering: true,
         
        });


$('#example-filterBehavior.drugi').multiselect({
            enableFiltering: true,
            filterBehavior: 'value',
            nonSelectedText: 'Select Framework',
            enableCaseInsensitiveFiltering: true,
           
        });



/*
$('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();

  
    $('.prvi option:selected').each(function(){
      $vri =$(this).prop('selected', false);
     alert ($vri.value);

    });
     

 });

*/

$('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
 
  $.ajax({
   url:"prikaz_multi.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {

    $('.prvi option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('.prvi').multiselect('refresh');
    //alert(data);
    $('.drugi option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('.drugi').multiselect('refresh');
    $("#Trazilica_prikaz").append(data);
    $("#Tablica").hide();

     //window.location.href = data.redirecturl;
   }
  });
 });


$( "#dugme" ).click(function() {
   $("table").hide();
});
 


});
</script>

 
</body>
</html>