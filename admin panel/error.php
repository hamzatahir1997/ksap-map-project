<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
  include "languages/spanish/error.php";
}
else{
  include "languages/english/error.php";
}

if(isset($_POST['BackToHome'])){
    $path = 'index.php';
      echo "<script>
  
      document.location= '$path';
  
      </script>";
    //header('Location:index.php');
  }
 ?>


<!DOCTYPE html>
<html>
<head>
        <title><?php echo $page_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style4.css">

  
 </head>
    <body>
        <div class="container">
        <form action="" method="POST">
            <div class="row mt-5">
            <div class="col-12">
            <select id="language" class="form-select" aria-label="Default select example">
            <?php if($_SESSION["English"]==false || $_SESSION["English"]=="false") {  ?> 
            <option value="false">Spanish</option>
            <option value="true">English</option>
            <?php } else { ?>
            <option value="true">English</option>
            <option value="false">Spanish</option>
            <?php } ?>
            </select>
            </div>
                <div class="col-6 mt-5">
                    <img src="../pics/19.png" class="center-block img-fluid">
                </div> 
            <div class="col-6 d-flex justify-content-center">
                <div class="row">
                        <div class="col mt-5">
                            <h4><?php echo $e1; ?></h4>
                            <br> 

                            <strong><h1><?php echo $e2; ?></h1></strong>
                            <br> 
                   
                             <h5><?php echo $e3; ?></h5> 
                             <br>
                             <h3><?php echo $e4; ?></h3> 
                           <?php //<button id="select-submit"name="BackToHome" type="" class="btn text-center"><strong>Click here to Login</strong> </button>?>
                        </div>
               
                </div> 
            </div>
            </div>

        
        
         </form>
           
        </div>
        <script>
console.log("SCRIPT LOADED");
document.querySelector("#language").onchange = function(e){
    console.log(e.target.value);
var url = `../config.php?English=${e.target.value}`;
var formData = new FormData();
fetch(url)
.then(function (response) {
  return response.text();
})
.then(function (body) {
  console.log(body);
  window.location.reload();
});
}
</script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    </body>
</html>

