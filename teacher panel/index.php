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
        <title><?php echo $teacher_login; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style1.css">
<?php 


if(isset($_POST['but_submit'])){
    
   
   
    $uname = mysqli_real_escape_string($con,$_POST['uname']);
    $upassword = mysqli_real_escape_string($con, $_POST['upassword']);
    $upassword = md5($upassword);
    
   
    if ($uname != "" && $upassword != ""){

        if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
            $sql_query = "select agency,count(*) as cntUser from teacher_data where uname='".$uname."' and upassword='".$upassword."'";
           
          }
          else{
            $sql_query = "select agency,count(*) as cntUser from teacher_data where email='".$uname."' and upassword='".$upassword."'";
          }
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];
        if($count > 0)
          {
            
          $sql_query = "select id as schoolCheck from school_map where agency='".$row['agency']."'";
          $result = mysqli_query($con,$sql_query);
          $row = mysqli_fetch_array($result);
          $schoolCheck = $row['schoolCheck'];

          if($schoolCheck>0){
            if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
                $sql_query = "SELECT agency,uname,id FROM teacher_data WHERE uname ='$uname'";
                $result = mysqli_query($con,$sql_query);
                $row = mysqli_fetch_array($result);
                $_SESSION['teacher_name'] = $uname;
         
                $_SESSION['tid'] = $row['id'];
                $path = '../admin panel/selectSchool.php?agency="'.$row['agency'];
                echo "<script>
        
                document.location= '$path';
        
                </script>";
                //header("Location: ../admin panel/SurveyReport2.php?agency='".$row['agency']."'&school=".$row['school']);
              }
            else{
                $sql_query = "SELECT uname,agency,id FROM teacher_data WHERE email ='$uname'";
                $result = mysqli_query($con,$sql_query);
                $row = mysqli_fetch_array($result);
                $_SESSION['teacher_name'] = $row['uname'];
            
                $_SESSION['tid'] = $row['id'];
                $path = '../admin panel/selectSchool.php?agency="'.$row['agency'];
                echo "<script>
        
                document.location= '$path';
        
                </script>";
                
                //header("Location: ../admin panel/SurveyReport2.php?agency='".$row['agency']."'&school=".$row['school']);
            }
           
        }
        
        else{
           
            $error_message= $em1;
        }
    }
    else{
        $error_message= $em2;
        
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
            <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $teacher_login; ?></h2>
        </div>
        <?php 

					if(!empty($error_message)){
					?>
						<div class="alert alert-danger temp">
						  	<strong><?php echo $errort; ?></strong> <?= $error_message ?>
						</div>

					<?php
					}
					?>


        <div class="login-container jumbotron image-3 img-fluid">
        <h2 class="text-center font-weight-bold text-uppercase"><?php echo $teacher_login2; ?></h2>
        <h5 class="text-center text-custom"><?php echo $welcome; ?><br><br></h5>
        <div class=login-form>

                <div class="form-group">
                    <label for="uname/email"><h6><?php echo $usernamel; ?></h6></label>
                    <input type="text" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $usernamep; ?>" name="uname">
                </div>
                <div class="form-group">
                    <label for="upassword"><h6><?php echo $passwordl; ?></h6></label>
                    <input type="password"id="upassword" name="upassword" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $passwordp; ?>">
                </div>
                </div> 
                <div class="form-row justify-content-center align-items-center form-group">
                    <div class="col-auto darkblue">
                        <a href="forgot_password.php"><?php echo $forgot; ?></a>
                    </div>
              
                </div> 
                <p class="darkblue"> 
            <?php echo $newhere; ?>  
            <a href="signup.php"> 
                <?php echo $click_register; ?>
            </a> 
        </p>   
                <div class="row justify-content-center align-items-center form-group">
                    <button type="submit"value="Submit" name="but_submit" class="btn btn-submit btn-lg text-uppercase text-center"><?php echo $sign_in; ?></button>
                 
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
