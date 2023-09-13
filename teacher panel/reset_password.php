<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/reset_password.php";
}
else{
    include "languages/english/reset_password.php";
}

include("app_logic.php");
if(!isset($_SESSION['teacher_name'])){
   
    $token=$_GET["token"];
}

?>

<!DOCTYPE html>
<html>
<head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style1.css">

  
 </head>
    <body>
        <div class="container">

        
            <form action="" method="post">

            <div class="jumbotron image-1 img-fluid text-light"> 
            <div class="row">
            <div class="col-12 spanish_select d-flex justify-content-end">
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
                <div class="change row">
                    <div class="col-sm-4">
                        <img src="../pics/6.png"class="responsive">
                    </div>     
            </div>
            </div>
            <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $title; ?></h2>
        </div>
        <?php include('messages.php'); ?>
        <div class="login-container jumbotron image-3 img-fluid">		
        <h5 class="text-custom"><?php echo $heading; ?><br><br></h5>
        <div class=login-form>

                <div class="form-group">
                    <label for="upassword"><h6><?php echo $passwordl; ?></h6></label>
                    <input required type="password" id="upassword" name="upassword" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $passwordp; ?>">
                </div>
                <div class="form-group">
                    <label for="urpassword"><h6><?php echo $rpasswordl; ?></h6></label>
                    <input required type="password"id="urpassword" name="urpassword" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $rpasswordp; ?>">
                </div>
               
                <div class="row justify-content-center align-items-center form-group">
                    <button type="submit"value="Submit" name="new_password" class="btn btn-submit text-uppercase text-center mt-4"><?php echo $button_t; ?></button>  
                </div>
                <input type="hidden"name="token_id" id="toke_id" value="<?php echo $token?>"></div>
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    </body>
</html>

