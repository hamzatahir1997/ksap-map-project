<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/signup.php";
}
else{
	include "languages/english/signup.php";
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
	<title><?php echo $teacher_register; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
	<link rel="stylesheet" href="style2.css">
	
	
	
	<?php 
	$error_message = "";$success_message = "";

	// Register user
	if(isset($_POST['create'])){
		$uname = trim($_POST['uname']);
		$agency = trim($_POST['agency']);
		$email = trim($_POST['email']);
		$upassword = mysqli_real_escape_string($con, $_POST['upassword']);
		$urpassword = mysqli_real_escape_string($con, $_POST['urpassword']);
		$code = trim($_POST['code']);
	
		
		
		
		$isValid = true;

		// Check fields are empty or not
		if($uname == '' || $agency == '' || $email == '' || $upassword == '' || $urpassword == '' || $code == ''|| $agency == '' ){
			$isValid = false;
			$error_message = $em1;
		}

		// Check if confirm password matching or not
		if($isValid && ($upassword != $urpassword) ){
			$isValid = false;
			$error_message = $em2;
		}

		// Check if Email-ID is valid or not
		if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  	$isValid = false;
		  	$error_message = $em3;
		}


		$sql_query = "select school_code,count(*) as cntCode from school_map where status=1 and school_code='".$code."'";
		$result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['cntCode'];
		if($isValid && (($count == 0)))
		{
			$isValid = false;
			$error_message = $em4;
		}
		if($isValid && (($count > 0)))
		{
			$sql_query = "select  school_code,agency,count(*) as cntCodeandAgency from school_map where status=1 and school_code='".$code."' and agency='".$agency."'";
			$result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        	$count = $row['cntCodeandAgency'];
			if($isValid && (($count == 0))){
				$isValid = false;
			    $error_message = $em5;

			}

		}

		if($isValid){

			// Check if Email-ID already exists
			$stmt = $con->prepare("SELECT * FROM teacher_data WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if($result->num_rows > 0){
				$isValid = false;
				$error_message = $em6;
			}
		}
			
			
		if($isValid){

			// Check if User already exists
			$stmt = $con->prepare("SELECT * FROM teacher_data WHERE uname = ?");
			$stmt->bind_param("s", $uname);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if($result->num_rows > 0){
				$isValid = false;
				$error_message = $em7;
			}
			
		
		}

		// Insert records
		if($isValid){
			$upassword = md5($upassword); //Password Encrypted
			$insertSQL = "INSERT INTO teacher_data(uname,agency,email,upassword,code ) values(?,?,?,?,?)";
			$stmt = $con->prepare($insertSQL);
			$stmt->bind_param("sssss",$uname,$agency,$email,$upassword,$code);
			$stmt->execute();
			$stmt->close();
			$success_message = $sm1;
		
		}
	}
	?>
</head>
<body>
	<div class='container'>
			
				<form method='post' action=''>

				<div class="upper jumbotron image-1 img-fluid text-light text-uppercase"> 
                <div class="row change">
				<div class="col-12">
                        <img class="float-right"src="../pics/6.png"  class="img-fluid responsive">
                    </div>   
				</div>
				<br>
				<br>
                <h2 style="font-weight:800" class="text-center"><?php echo $create_account; ?></h2>
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
            						<a href="index.php"> 
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
                <label for="uname"><h6><?php echo $namel; ?></h6></label>
                <input type="text"name="uname"required id="uname"class="form-control rounded-pill form-control-sm" placeholder="<?php echo $namep; ?>" >
                </div>
                <div class="form-group">
                    <label for="email"><h6><?php echo $emaill; ?></h6></label>
                    <input type="email"id="email" name="email" required  class="form-control rounded-pill form-control-sm"id="email" placeholder="<?php echo $emailp; ?>">
                </div>
                <div class="form-group">
                    <label for="upassword"><h6><?php echo $passwordl; ?></h6></label>
                    <input type="password" id="upassword" name="upassword" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $passwordp; ?>">
                </div>
                <div class="form-group">
                    <label for="urpassword"><h6><?php echo $rpasswordl; ?></h6></label>
                    <input type="password"id="urpassword" name="urpassword" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $rpasswordp; ?>">
                </div>
                <div class="form-group">
                    <label for="code"><h6><?php echo $codel; ?></h6></label>
                    <input type="text"id="code" name="code" required class="form-control rounded-pill form-control-sm" placeholder="<?php echo $codep; ?>">
                </div>
				<div class="form-group">
				<label for="agency"><h6><?php echo $agencyl; ?></h6></label>
				<select required id="agency"name="agency" class="custom-select js-example-basic-single">
				<option value=""><?php echo $agencyp; ?></option>
						<?php 
							$sql = mysqli_query($con, "SELECT DISTINCT agency FROM school_map  where status = 1 ORDER BY agency");
							while ($row = $sql->fetch_assoc()){
							//echo "<option value=".$row["agency"].">" . $row['agency'] . "</option>";
							echo "<option value='$row[agency]'>" . $row['agency'] . "</option>";
							}
						?>
					</select>
                </div>
			
				</div>
                <div class="row justify-content-center align-items-center form-group">
                    <p><br><br><br></p>
                    <button type="submit" id="register" name="create" value="Sign Up" class="btn btn-submit btn-lg text-uppercase text-center"><?php echo $sign_up; ?></button>
                </div>
				<div class="row justify-content-center align-items-center form-group darkblue">
						<a href="index.php"><?php echo $already; ?></a>
                </div>

					</div>
				</form>
		</div>

	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
		<script src="index.js"></script>
</body>
</html>