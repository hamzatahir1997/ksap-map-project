<?php 
include "../config.php";
include("app_logic.php");
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/forgot_password.php";
}
else{
    include "languages/english/forgot_password.php";
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

        <form action="forgot_password.php" method="post">

            <div class="jumbotron image-1 img-fluid text-light"> 
            <div class="row">
                <div class="change row">
                    <div class="col-sm-4">
                        <img src="../pics/6.png"class="responsive">
                    </div>     
            </div>
            </div>
            <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $title; ?></h2>
        </div>
        <?php include('messages.php'); ?>
        <?php		
        if(!empty($success_message)){
					?>
						<div class="alert alert-success temp">
						  	<strong><?php echo $successt;?></strong> <?= $success_message ?>
						

						</div>

                        <?php
					}
		?>
        <div class="login-container jumbotron image-3 img-fluid">		
        <h5 class="text-custom"><?php echo $heading; ?><br><br></h5>
        <div class=login-form>

                <div class="form-group">
                    <label for="email"><h6><?php echo $emaill; ?></h6></label>
                    <input required type="email"id="email" name="email" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $emailp; ?>">
                </div>
                </div> 
               
                <div class="row justify-content-center align-items-center form-group">
                    <button type="submit"value="Submit" name="reset-password" class="btn btn-submit  text-uppercase text-center mt-5"><?php echo $button_t; ?></button>
                 
                </div>
        </div>
        </div>

            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    </body>
</html>

