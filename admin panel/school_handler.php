<?php
include "../config.php";


//$content_raw = file_get_contents("php://input"); // THIS IS WHAT YOU NEED
//$decoded_data = json_decode($content_raw, true); // THIS IS WHAT YOU NEED
//echo $decoded_data;

$school_id = $_POST['school_id'];
$school_id = json_decode($school_id);
    
$query="SELECT DISTINCT id FROM school_floor where school_id= ". $school_id;
$sql = mysqli_query($con, $query );  
$floors = array();
while ($row = $sql->fetch_assoc()){
array_push($floors,$row);
}

print_r(json_encode($floors));


?>









    