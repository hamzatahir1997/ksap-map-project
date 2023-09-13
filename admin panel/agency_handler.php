<?php
include "../config.php";


//$content_raw = file_get_contents("php://input"); // THIS IS WHAT YOU NEED
//$decoded_data = json_decode($content_raw, true); // THIS IS WHAT YOU NEED
//echo $decoded_data;

$agency_name=$_POST["agency_name"];
$agency_name = json_encode($agency_name);
$query="SELECT DISTINCT id,sname FROM school_map  where status = 1 AND agency= ". $agency_name ;
$sql = mysqli_query($con, $query );  
$schools = array();
while ($row = $sql->fetch_assoc()){
array_push($schools,$row);
}
print_r(json_encode($schools));


?>
