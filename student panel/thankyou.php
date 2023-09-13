<?php 
include "../config.php";

if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/thankyou.php";
}
else{
    include "languages/english/thankyou.php";
}

if(isset($_POST['BackToHome'])){

    $path = '../index.php';
    echo "<script>

    document.location= '$path';

    </script>";

    //header('Location:../1.php');
  }
 ?>
<script>

window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};

</script>

<!DOCTYPE html>
<html>
<head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style2.css">

  
 </head>
    <body>
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-12">
                    <img src="../pics/13.png" width=100% class="img-fluid center-block">
                </div> 
         </div>
         <div class="row size">
            <div class="col-12">
                <h1 class="t text-center font-weight-bolder text-uppercase"><?php echo $title; ?></h1>
            </div> 
         </div>
         <div class="row size">
            <div class="col-12">
                <h3 class="text-center"><?php echo $des; ?></h3>
            </div> 
         </div>
            
            
            <form action="" method="POST">

            <div class="mt-5 row">

                <div class="col-12 mt-5 d-flex justify-content-center">
                    <button id="select-submit"name="BackToHome" type="submit" class="btn text-center"><strong><?php echo $back; ?></strong> </button>
                </div>
            </div>

            

        </form>
           
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    </body>
</html>

