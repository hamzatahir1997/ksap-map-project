<?php
include "../config.php";

	$error_message = "";$success_message = "";
 $school = trim($_POST['school']);
 $floor = trim($_POST['floor']);
		
// Check if the form was submitted
$sql_query = "select count(*) as FloorCheck from school_floor where school_id='".$school."' and floorlevel='".$floor."' and status=1";
$result = mysqli_query($con,$sql_query);
$row = mysqli_fetch_array($result);
$count = $row['FloorCheck'];
if($count==0){
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("svg" => "image/svg+xml", "SVG" => "image/SVG");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    $guid = bin2hex(openssl_random_pseudo_bytes(16));
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
                move_uploaded_file($_FILES["photo"]["tmp_name"], "mapuploads/". $guid . $filename);
				//adding code here
				 $path = "mapuploads/". $guid . $filename;
			  $insertSQL = "INSERT INTO school_floor(school_id,url,floorlevel ) values(?,?,?)";
			  $stmt = $con->prepare($insertSQL);
			  $stmt->bind_param("sss",$school,$path,$floor);
			  $stmt->execute();
			  $stmt->close();
              $success_message = "School Map added successfully.";
              
				
                echo "Your file was uploaded successfully." ;
                $path = 'map-upload.php';
                echo "<script>
               document.location= '$path';
                </script>";
                //header ("Location: map-upload.php");
            
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
} 
}
else{
   // $error_message="This floor is already uploaded";
    echo "This floor is already uploaded";
}
?>