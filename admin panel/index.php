<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/index.php";
}
else{
    include "languages/english/index.php";
}
?>
<!DOCTYPE html>
<html>
<head>
        <title><?php echo $admin_login; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style1.css">
<?php 



if(isset($_POST['but_submit'])){
    
   
   
    $admin_name = mysqli_real_escape_string($con,$_POST['admin_name']);
    $admin_password = mysqli_real_escape_string($con, $_POST['admin_password']);

    
   
    if ($admin_name != "" && $admin_password != ""){
           
        if (!filter_var($admin_name, FILTER_VALIDATE_EMAIL)) {
            $sql_query = "select count(*) as cntUser from admin_data where admin_name='".$admin_name."' and admin_password='".$admin_password."'";
          }
          else{
        $sql_query = "select count(*) as cntUser from admin_data where admin_email='".$admin_name."' and admin_password='".$admin_password."'";
          }
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            if (!filter_var($admin_name, FILTER_VALIDATE_EMAIL)) {
                $sql_query = "SELECT admin_name,id FROM admin_data WHERE admin_name ='$admin_name'";
                $result = mysqli_query($con,$sql_query);
                $row = mysqli_fetch_array($result);
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['aid'] = $row['id'];
                $path = 'selectSchool.php';
                    echo "<script>
                    document.location= '$path';
                        </script>";
                //header('Location: selectSchool.php');
              }
            else{
                $sql_query = "SELECT admin_name,id FROM admin_data WHERE admin_email ='$admin_name'";
                $result = mysqli_query($con,$sql_query);
                $row = mysqli_fetch_array($result);
                $_SESSION['admin_name'] = $row['admin_name'];
                $_SESSION['aid'] = $row['id'];
                $path = 'selectSchool.php';
                    echo "<script>
                    document.location= '$path';
                        </script>";
                
                //header('Location: selectSchool.php');
                
            }
           
        }else{
            $error_message= "Invalid username and password";

        }

    }
    

}
?>

  
 </head>
    <body>
        <div class="container">
            <form method="post" action="">

            <div class="jumbotron image-1 img-fluid text-light"> 
            <div class="row change">
            <div class="col-12 spanish_select">
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
            <div class="col-12">
                        <img class="float-right logo"src="../pics/6.png"  class="img-fluid responsive">
                    </div> 
            </div>
            <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $login; ?> </h2>
        </div>
        <?php 

					if(!empty($error_message)){
					?>
						<div class="alert alert-danger temp">
						  	<strong>Error!</strong> <?= $error_message ?>
						</div>

					<?php
					}
					?>


        <div class="login-container jumbotron image-3 img-fluid">
        <h2 class="text-center font-weight-bold text-uppercase"><?php echo $admin_login; ?></h2>
        <div class=login-form>

                <div class="form-group">
                    <label for="admin_name/admin_email"><h6><?php echo $usernamel; ?></h6></label>
                    <input type="text" name="admin_name"required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $usernamep; ?>">
                </div>
                <div class="form-group">
                    <label for="admin_password"><h6><?php echo $passwordl; ?></h6></label>
                    <input type="password"id="admin_password" name="admin_password" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $passwordp; ?>">
                </div>
                </div>
                <br>
                <br>
                <div class="row justify-content-center align-items-center form-group">
                    <button type="submit"value="Submit" name="but_submit" class="btn btn-submit btn-lg text-uppercase text-center"><?php echo $sign_in;?></button>
                 
                </div>
        </div>

            </form>
            <div class="footer container">
        <div class="row">
            <div class="col-12 text-center mt-3">
                <h6>
                <?php echo $copyright; ?>
            </h6>
            </div>
        </div>
    </div>
          
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

