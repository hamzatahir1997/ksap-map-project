<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
	include "languages/spanish/editSchool.php";
  }
  else{
	include "languages/english/editSchool.php";
  }
  



if(!isset($_SESSION['admin_name'])){

	$path = 'error.php';
      echo "<script>
  
      document.location= '$path';
  
      </script>";
   
    //header('Location:error.php');
    exit;
}
// logout
if(isset($_POST['but_logout'])){
	session_destroy();
	$path = 'index.php';
      echo "<script>
  
      document.location= '$path';
  
      </script>";
    //header('Location: index.php');
}
$school_id = $_GET["id"];


	if(isset($_POST['create'])){
		$error_message = "";$success_message = "";
		$sname = trim($_POST['sname']);
		$s_type = trim($_POST['s_type']);
        $agency = trim($_POST['agency']);
		$school_code = trim($_POST['school_code']);

        
        if(isset($_POST['checkbox'])) {
            $status=1;
        } 
        else{
        
            $status=0;
        }
              
		
		$isValid = true;


		// Check fields are empty or not
		if($sname == '' || $s_type == '' || $agency == '' || $school_code == ''  ){
			$isValid = false;
			$error_message = $em1;
		}


		if($isValid){

			// Check if school already exists
			$stmt = $con->prepare("SELECT * FROM school_map WHERE sname = ? && s_type = ? && id = ? && agency = ? && status = ? && school_code = ?");
			$stmt->bind_param("ssssss", $sname,$s_type,$school_id,$agency,$status,$school_code);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if($result->num_rows > 0){
				$isValid = false;
				$error_message = $em2;
			
			}
		}
			

		// Insert records
		if($isValid){  

            $insertSQL="UPDATE `school_map` SET `sname`=?,`s_type`=?,`agency`=? ,`status`=? ,`school_code`=? WHERE id=$school_id";

            //"UPDATE school_map(sname,s_type,agency) WHERE id=$school_id values(?,?,?)";

			 //= "INSERT INTO school_map(sname,s_type,agency ) values(?,?,?)";
			$stmt = $con->prepare($insertSQL);
			$stmt->bind_param("sssss",$sname,$s_type,$agency,$status,$school_code);
			$stmt->execute();
			$stmt->close();
			$success_message = $sm1;
		
		}
	}
	?>
	<!doctype html>
<html lang="en">
<head>
	<title><?php echo $edit_schoolt; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class='container'>
	<form method='post' action=''>
			
				

				<div class="upper jumbotron image-1 img-fluid text-light"> 
			<div class="row">
				<?php  if (isset($_SESSION['admin_name'])) : ?>
					<div class="col-12">
                <input class="btn but_logout btn-sm" type="submit" value="<?php echo $logout; ?>"name="but_logout" >
                </div>       
		   <?php endif ?> 
		   
		   			<div class="col-12">
                        <img class="float-right"src="../pics/6.png"  class="img-fluid responsive">
                    </div>  
		   
		   </div>
                <h2 class="text-center font-weight-bold"><br><?php echo $edit_school; ?></h2>
			</div>
			
					<?php 
					// Display Error message
					if(!empty($error_message)){
					?>
						<div class="alert alert-danger temp">
						  	<strong><?php echo $errort; ?></strong> <?= $error_message ?>
						</div>

					<?php
					}
					

					// Display Success message
					if(!empty($success_message)){
					?>
						<div class="alert alert-success temp">
						  	<strong><?php echo $successt; ?></strong> <?= $success_message ?>
							  <p class=temp> 
            					 <?php echo $info1; ?>
            						<a href='listschool.php'> 
               						  <?php echo $info2; ?> 
            						</a> 
        				</p>

						</div>
				   

					<?php
					}
					?>
			
			<div class="login-container jumbotron image-3 img-fluid">
				<div class="login-form">
				<div class="form-group">
                <label for="sname"><h6><?php echo $school_name; ?></h6></label>
                <input type="text"name="sname" id="sname"class="form-control rounded-pill form-control-sm" placeholder="<?php echo $school_namep; ?>"
                value="<?php  $sql = mysqli_query($con, "SELECT sname FROM school_map where id=". $school_id);
                                     $row = $sql->fetch_assoc();
                                     echo $row['sname'];  ?>" >
                </div>
                <div class="form-group">
					<label for="s_type"><h6>Select <?php echo $school_type; ?></h6></label>
                    <select  name="s_type" class="custom-select">
				<option  value="<?php  $sql = mysqli_query($con, "SELECT s_type FROM school_map where id=". $school_id);
                                    $row = $sql->fetch_assoc();
                                    echo $row['s_type'];  ?>" hidden>
                         
                         
                       <?php  $sql = mysqli_query($con, "SELECT s_type FROM school_map where id=". $school_id);
					    $row = $sql->fetch_assoc();
                        echo $row['s_type']; ?></option>
          			  <option value="Middle School"><?php echo $school_typeo1; ?></option>
					  <option value="High School"><?php echo $school_typeo2; ?></option>
					  <option value="Community School"><?php echo $school_typeo3; ?></option>
        		</select>
                </div>
			
                <div class="form-group">
                    <label for="agency"><h6><?php echo $agencyl; ?></h6></label>
                    <input type="text"id="agency" name="agency"  class="form-control rounded-pill form-control-sm"id="area" placeholder="<?php echo $agencyp; ?>"
                    value="<?php  $sql = mysqli_query($con, "SELECT agency FROM school_map where  id=". $school_id);
							$row = $sql->fetch_assoc();
                            echo $row['agency'];  ?>" >
                </div>
				<div class="form-group">
                <label for="school_code"><h6><?php echo $school_code; ?></h6></label>
                <input type="text"name="school_code" id="school_code"class="form-control rounded-pill form-control-sm" placeholder="<?php echo $school_codep; ?>"
                value="<?php  $sql = mysqli_query($con, "SELECT school_code FROM school_map where id=". $school_id);
                                     $row = $sql->fetch_assoc();
                                     echo $row['school_code'];  ?>" >
                </div>
                <br>
    
             <div class="form-group custom-control custom-switch">
                   <input type="checkbox"name="checkbox" class="custom-control-input" id="customSwitch1"
                   <?php  $sql = mysqli_query($con, "SELECT status FROM school_map where  id=". $school_id);
							$row = $sql->fetch_assoc();
                            if($row['status']==1):?> checked<?php endif; ?>>
                 <label class="custom-control-label" for="customSwitch1"><h6><?php echo $statusl; ?></h6> </label>
             </div>
                 
				</div>
                
                <div class="row justify-content-center align-items-center form-group">
                    <p><br><br><br></p>
                    <button type="submit" id="register" name="create" value="Sign Up" class="btn btn-primary btn-lg text-uppercase text-center"><?php echo $update; ?></button>
                </div>
				<div class="row justify-content-center align-items-center form-group">
						<a href='listschool.php'><?php echo $school_list_link; ?></a> 
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