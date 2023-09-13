<?php 
include "../config.php";

if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/index.php";
}
else{
    include "languages/english/index.php";
}

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php 

$error_message = "";$error_message1 = "";$success_message = "";


    $isValid = true;
  
	if(isset($_POST['btn_submit'])){
    if(isset($_POST['school_code'])&&isset($_POST['gender'])&&isset($_POST['religion'])&&isset($_POST['race'])&&isset($_POST['S_orient'])&&isset($_POST['grade']))
    {
    $gender = trim($_POST['gender']); 
    $religion = trim($_POST['religion']);
    $race = implode(" , ",$_POST['race']);
    $S_orient = trim($_POST['S_orient']); 
    $grade = trim($_POST['grade']);
    $d_gender = trim($_POST['d_gender']);
    $d_religion = trim($_POST['d_religion']);
    $d_race = trim($_POST['d_race']);
    $d_S_orient = trim($_POST['d_S_orient']);
    $school_code = trim($_POST['school_code']);
    $guid = trim($_POST['guid']);

    
    
    if($d_gender == ''){
	
      $d_gender = "Not defined";
    }
    if($d_religion == ''){
	
      $d_religion = "Not defined";                   
    }
    if($d_race == ''){
	
      $d_race = "Not defined";
    }
    if($d_S_orient == ''){
	
      $d_S_orient = "Not defined";
    }


  
     
		if($school_code == '' ||$grade == '' || $gender == '' || $religion == '' || $race == '' || $S_orient == ''){
			$isValid = false;
			$error_message = $em1;
    }
 

	
		if($isValid){
     
			//$insertSQL = "INSERT INTO survey_data(school_id,grade,gender,d_gender,religion,d_religion,race,d_race,S_orient,d_S_orient ) values(?,?,?,?,?,?,?,?,?,?)";
			//$stmt = $con->prepare($insertSQL);
			//$stmt->bind_param("ssssssssss",$school,$grade,$gender,$d_gender,$religion,$d_religion,$race,$d_race,$S_orient,$d_S_orient);
			//$stmt->execute();
			//$stmt->close();
     // $success_message = "Data entered successfully.";  

     $school_code_query='SELECT DISTINCT id FROM school_map  where status = 1  AND school_code= "'.$school_code.'"';
     $sql1 = mysqli_query($con,$school_code_query);
     $row1 = mysqli_fetch_array($sql1);
     $_SESSION['grade'] = $grade;
     $_SESSION['gender'] = $gender;
     $_SESSION['d_gender'] = $d_gender;
     $_SESSION['religion'] = $religion;
     $_SESSION['d_religion'] = $d_religion;
     $_SESSION['race'] = $race;
     $_SESSION['d_race'] = $d_race;
     $_SESSION['S_orient'] = $S_orient;
     $_SESSION['d_S_orient'] = $d_S_orient;
     $_SESSION['guid'] = $guid;
     $_SESSION['array'] = [];
     if($row1)
     {
     $_SESSION['school_id'] = $row1['id'];
     $query="SELECT DISTINCT id,school_id,floorlevel, url FROM school_floor  where status = 1  AND school_id= ".$row1['id'];
     $sql = mysqli_query($con, $query );
     $row = mysqli_fetch_array($sql);
     if($row)
     {

      $path = 'mapfeedback.php?url='.$row["url"] . '&lvl='.$row['floorlevel'].'&school_id='.$row["school_id"]. '&guid='.$guid;
        echo "<script>

        document.location= '$path';

        </script>";

     
       //header("Location: mapfeedback.php?url=".$row['url'] . "&lvl=1&school_id=".$school);

     }
     else{
      $error_message = $em2;
     }
    }
    else{
      $error_message = $em3;
    }
    }
  }
  else{
    $error_message = $em4;
  }
}

?>
   

<!doctype html>
<html lang="en">
<head>
	<title><?php echo $survey_form; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="style.css">
</head>


<body>
	<div class='container'>
      <div class="upper-container jumbotron image-1 img-fluid text-light"> 
        
             <div id="parent"class="row justify-content-center align-items-center">
                     
                 <div class="image-2 justify-content-center align-items-center">
                     <img src="../pics/6.png" width=300 alt="bootstrap logo"class="responsive1 img-fluid">
                 </div>
                 <div class="image-4 justify-content-center align-items-center">
                    <img src="../pics/4.png" width=600 alt="bootstrap logo"class="responsive img-fluid">
                 </div> 
             </div> 
                     
                     
             <div class="row justify-content-center align-items-center">
                 <span class="badge badge-pill badge-primary text-center font-weight-bold text-uppercase"><h2 <?php if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){ ?> class="spanish_form" <?php }?> ><?php echo $survey_form; ?></h2></span>
             </div>
         
         
         </div>

         <?php 
					// Display Error message
					if(!empty($error_message)){
					?>
						<div class="alert alert-danger">
						  	<strong><?php echo $errort; ?></strong> <?= $error_message ?>
						</div>

					<?php
          }
          
					// Display Success message
					if(!empty($success_message)){
					?>
						<div class="alert alert-success">
						  	<strong><?php echo $successt; ?></strong> <?= $success_message ?>
						</div>
				   

					<?php
					}
					?>
   

     <div class="login-container jumbotron image-3 img-fluid">

     <form method='post' action=''>
     <div class="form-label width">
				<label for="school_code"><h6><?php echo $school_codel; ?></h6></label></br>
        <input required type="text"name="school_code" id="school_code"class="form-control" placeholder="<?php echo $school_codep; ?>">
			</div>
      <br>

             <div class="form-label width">
                 <label for="grade"><h6><?php echo $gradel; ?></h6></label>
                 <input required type="text"name="grade" id="grade"class="form-control" placeholder="<?php echo $gradep; ?>">
             </div>
             <h6><br><?php echo $genderl; ?></h6>
             <div class="form-check width rounded">
                 <br>

                 <label class="form-check-label" for="Agender">
                    <input required type="radio" class="form-check-input"  name="gender"id="Agender" value="Agender"><?php echo $agender; ?>
                 </label>
                 <br>
            
                 <label class="form-check-label" for="Female">
                    <input type="radio"class="form-check-input"  name="gender" id="Female"value="Female" ><?php echo $female; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Male">
                     <input type="radio" class="form-check-input"  name="gender"id="Male" value="Male"><?php echo $male; ?>
                 </label>
                 <br>
                 <label class="form-check-label"style=" " for="Transgender">
                     <input type="radio" class="form-check-input"  name="gender"id="Transgender" value="Transgender"><?php echo $transgender; ?>
                 </label>
                 <br>
                 <label class="form-check-label1" for="PreferNot">
                      <input type="radio" class="form-check-input" name="gender"id="PreferNot" value="Prefer Not to Answer"><?php echo $prefer_not; ?>    
                 </label>
                 <br>
                 <br>
             </div>
             <label for="comment"><h6><?php echo $prefer_define; ?></h6></label><span> <img src="../pics/plus.png" class="define-toggler"> </span>
             <div class="width">
                 <textarea
                     style="width:100%" class="comment rounded width"id="comment1" rows="5"  name="d_gender">
                 </textarea>
             </div>
             <h6><br><?php echo $religionl; ?></h6>
             <div class="form-check width rounded ">
                  <br>
                 <label class="form-check-label" for="Christian">
                   <input required type="radio"class="form-check-input"name="religion" id="Christian"value="Christian" ><?php echo $christian; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Hindu">
                   <input type="radio"class="form-check-input"name="religion"id="Hindu" value="Hindu" ><?php echo $hindu; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Jewish">
                   <input type="radio"class="form-check-input"name="religion"id="Jewish" value="Jewish" ><?php echo $jewish; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Muslim">
                   <input type="radio"class="form-check-input"name="religion"id="Muslim" value="Muslim" ><?php echo $muslim; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Non-Mainstream">
                     <input type="radio" class="form-check-input" name="religion"id="Non-Mainstream" value="Non-Mainstream Religion(i.e. Polytheism,Wiccan)"><?php echo $non_main; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="No-Religion">
                     <input type="radio"class="form-check-input"  name="religion"id="No-Religion" value="No Religion" ><?php echo $noReligion; ?>
                   </label>
                 <br>
                 <label class="form-check-label" for="Questioning">
                     <input type="radio"class="form-check-input" name="religion"id="Questioning" value="Questioning" ><?php echo $questioning; ?>
                   </label>
                 <br>
                   <label class="form-check-label" for="Sikh">
                     <input type="radio"class="form-check-input" name="religion"id="Sikh" value="Sikh" ><?php echo $sikh; ?>
                   </label>
                   <br>
                 <label class="form-check-label1"style=" " for="Prefer-Not">
                     <input type="radio" class="form-check-input" name="religion"id="Prefer-Not"value="Prefer not to Answer"><?php echo $prefer_not; ?>
                 </label>
                 <br>
                 <br>
             </div>
             <label for="comment"><h6><?php echo $prefer_define; ?></h6></label><span> <img src="../pics/plus.png" class="define-toggler"> </span>
             <div class="width">
                 <textarea
                     style="width:100%" class="comment rounded width" rows="5" id="comment2" name="d_religion">
                 </textarea>
             </div>
             <h6 style=display:inline;><br> <?php echo $racel; ?></h6><h6 style="display:inline; font-size:16px;"> (<?php echo $select_all; ?>)</h6>
             <div class="form-check width rounded ">
                 <br>
                 <label class="form-check-label" for="asian">
                   <input  type="checkbox"class="form-check-input"id="asian" name="race[]" value="Asian" ><?php echo $asian; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="biracial">
                     <input type="checkbox"class="form-check-input"id="biracial" name="race[]" value="Biracial or Multiracial" ><?php echo $multiracial; ?>
                   </label>
                 <br>
                 <label class="form-check-label" for="black">
                     <input type="checkbox" class="form-check-input"id="black" name="race[]" value="Black/African"><?php echo $african; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="hispanic">
                     <input type="checkbox"class="form-check-input"id="hispanic" name="race[]" value="Hispanic/Latinx" ><?php echo $latinx; ?>
                  </label>
                   <br>
                 <label class="form-check-label" for="middleastern">
                     <input type="checkbox"class="form-check-input"id="middleastern" name="race[]" value="Middle Eastern" ><?php echo $eastern; ?>
                   </label>
                   <br>
                 <label class="form-check-label" for="NativeAmerican">
                     <input type="checkbox"class="form-check-input"id="NativeAmerican" name="race[]" value="Native American" ><?php echo $american; ?>
                   </label>
                   <br>
                 <label class="form-check-label" for="PacificIslander">
                     <input type="checkbox"class="form-check-input"id="PacificIslander" name="race[]" value="Pacific Islander" ><?php echo $pacific; ?>
                   </label>
                 <br>
                 <label class="form-check-label" for="White">
                     <input type="checkbox"class="form-check-input"name="race[]"id="White" value="White/Caucasian" ><?php echo $white; ?>
                   </label>
                   <br>
                 <label class="form-check-label1"style=" " for="Prefer-Not1">
                     <input type="checkbox" class="form-check-input" name="race[]"id="Prefer-Not1" value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                
                 <br>
                 <br>
             </div>
             <label for="comment"><h6><?php echo $prefer_define; ?></h6></label><span> <img src="../pics/plus.png" class="define-toggler"> </span>
             <div class="width">
                 <textarea
                     style="width:100%" class="comment rounded width" rows="5" id="comment3" name="d_race">
                 </textarea>
             </div>
             <h6><br><?php echo $s_orientationl; ?></h6>
             <div class="form-check width rounded ">
                 <br>
                 <label class="form-check-label" for="Bisexual">
                   <input required type="radio"class="form-check-input"id="Bisexual" name="S_orient" value="Bisexual" ><?php echo $bisexual; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Gay">
                     <input type="radio" class="form-check-input"id="Gay" name="S_orient" value="Gay"><?php echo $gay; ?>
                 </label>
                 <br>
                 <label class="form-check-label" for="Lesbian">
                     <input type="radio"class="form-check-input" name="S_orient"id="Lesbian" value="Lesbian" ><?php echo $lesbian; ?>
                   </label>
                   <br>
                   <label class="form-check-label" for="Pansexual">
                     <input type="radio"class="form-check-input" name="S_orient"id="Pansexual" value="Pansexual" ><?php echo $pansexual; ?>
                   </label>
                 <br>
                 <label class="form-check-label" for="Questioning1">
                     <input type="radio"class="form-check-input" name="S_orient"id="Questioning1" value="Questioning" ><?php echo $questioning; ?>
                   </label>
                 <br>
                 <label class="form-check-label" for="Straight">
                     <input type="radio"class="form-check-input" name="S_orient"id="Straight" value="Straight" > <?php echo $straight; ?>
                   </label>
                   <br>
                 <label class="form-check-label1"style=" " for="Prefer-Not2">
                     <input type="radio" class="form-check-input" name="S_orient"id="Prefer-Not2" value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                 <br>
                 <br>
             </div>
             <label for="comment"><h6><?php echo $prefer_define; ?></h6></label><span> <img src="../pics/plus.png" class="define-toggler"> </span>
             <div class="width">
                 <textarea
                     style="width:100%" class="comment rounded width" rows="5" id="comment4" name="d_S_orient">
                 </textarea>
             </div>
             <input type="hidden" id="guid" name="guid" value="">
             <div class="row justify-content-center align-items-center mt-5">
                 <p><br><br><br></p>
                 <button type="submit"value="submit"name="btn_submit" class="btn btn-submit btn-lg text-uppercase text-center"><?php echo $submit; ?></button>
             </div>
             </form>

             </div>

				
		</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <script>
   

   //document.getElementById("guid").value= uuidv4();
   //document.getElementById('guid').value=a;
   $(document).ready(function() {
   
     function uuidv4() {
   return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
   (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
   );
   }
   //alert (a);
   var a = uuidv4();
     $("#guid").val(a);
    
   });


   $(".define-toggler").click(function(){
    var textelem = $(this).parent().next().children()[0];
    $(textelem).toggle(1000)
  });
   </script>

   
</body>
</html>

