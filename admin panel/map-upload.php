<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
	include "languages/spanish/mapupload.php";
  }
  else{
	include "languages/english/mapupload.php";
  }
  

if(!isset($_SESSION['admin_name'])){
	$path = 'error.php';
	echo "<script>

	document.location= '$path';

	</script>";
   
    //header('Location:error.php');
    exit;
}
if(isset($_POST['but_logout'])){
	session_destroy();
	$path = 'index.php';
	echo "<script>

	document.location= '$path';

	</script>";
    //header('Location: index.php');
}

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript"> 
// In your Javascript (external .js resource or <script> tag)

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>


<!doctype html>
<html lang="en">
<head>
	<title><?php echo $add_mapt; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	

</head>
<body>
	<div class='container'>
			
			
				

	<div class="upper jumbotron image-1 img-fluid text-light"> 

		   <div class="row">
		   <form method="post"action="">
				<?php  if (isset($_SESSION['admin_name'])) : ?>
                <div class="col-12">
				<input class="btn but_logout btn-sm" type="submit" value="<?php echo $logout; ?>"name="but_logout" >
                </div>       
		   <?php endif ?>
		   </form> 
		   			<div class="col-12">
                        <img class="float-right"src="../pics/6.png"  class="img-fluid responsive">
                    </div>  
		   
		   </div>
		
                <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $add_map; ?></h2>
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
						</div>
				   

					<?php
					}
					?>
		
		<form method='post' action='map-upload-manager.php' enctype="multipart/form-data">
		
			<div class="login-container jumbotron image-3 img-fluid">
					
				<div class="login-form">
				<div class="form-group ">
				<label for="school"><h6><?php echo $select_school; ?></h6></label></br>
				<select required name="school" class="custom-select js-example-basic-single" width="100%">
          			  <option value=""><?php echo $select_schoolp; ?></option>
					  
					  <?php 
							$sql = mysqli_query($con, "SELECT DISTINCT id, sname, s_type FROM school_map  where status = 1 ");
							while ($row = $sql->fetch_assoc()){
							echo "<option value=".$row['id'].">" . $row['sname'] . " - ". $row['s_type'] . "</option>";
							}
						?>
        		</select>
			
				
				
        
					</div>
                <div class="form-group ">
				<label for="floor"><h6><?php echo $select_floor; ?></h6></label>
				<select required name="floor" class="custom-select">
				<option value=""><?php echo $select_schoolp; ?></option>
          			  <option value="1">1st</option>
					  <option value="2">2nd</option>
					  <option value="3">3rd</option>
					  <option value="4">4th</option>
					  <option value="5">5th</option>
					  <option value="6">6th</option>
					  <option value="7">7th</option>
					  <option value="8">8th</option>
					  <option value="9">9th</option>
					  <option value="10">10th</option>
					  <option value="11">11th</option>
					  <option value="12">12th</option>
					  <option value="13">13th</option>
					  <option value="14">14th</option>
					  <option value="15">15th</option>
					  
        		</select>
        
					</div>
                <div class="form-group">
                    <label for="fileToUpload"><h6>Upload Map</h6></label>
					  <input type="file" class="custom-select" required name="photo" id="fileSelect">
					  
                </div>
               
               
				 
  
				</div>
                <div class="row justify-content-center align-items-center form-group">
                    <p><br><br><br></p>
                  
					<input type="submit" value="<?php echo $submit; ?>" class="btn btn-submit btn-lg text-uppercase text-center" name="submit">
                </div>
				 <div class="row justify-content-center align-items-center form-group">
						 <a href='listschool.php'><?php echo $school_list_link; ?></a>
                 </div>

					</div>
				</form>
		</div>

	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>