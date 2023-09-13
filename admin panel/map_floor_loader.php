<?php
include "../config.php";


//$content_raw = file_get_contents("php://input"); // THIS IS WHAT YOU NEED
//$decoded_data = json_decode($content_raw, true); // THIS IS WHAT YOU NEED
//echo $decoded_data;

//$agency_name=$_POST["agency_name"];
//$agency_name = json_encode($agency_name);

$school_name = $_POST["school_name"];
$school_name = json_encode($school_name);
$floor_id = $_POST["floor_id"];

$condition = "";
if (isset($_SESSION['from_date']) && isset($_SESSION['to_date'])) {
    
    $from_date = $_SESSION['from_date'];
    $to_date = $_SESSION['to_date'];

    $condition = " AND s.insertedOn between '$from_date' AND '$to_date' ";

  } else {
    $condition = "";
  }

$query="SELECT DISTINCT id FROM school_map  where status = 1 AND sname= ". $school_name;
$sql = mysqli_query($con, $query );  
$row = $sql->fetch_assoc();

$school_id = $row['id'];


$query = $query="SELECT s.grade,s.gender,s.religion,s.race,s.s_orient as 'Orient',s.school_id,m.floor_id,m.color_data,s.guid FROM map_data m
inner join survey_data s on s.guid = m.guid
 where m.floor_id = '".$floor_id."' AND m.school_id= '".$school_id."'".$condition;
$sql = mysqli_query($con, $query );  
  
$map_data = array();
while ($row = $sql->fetch_assoc()){
array_push($map_data,$row);
//print_r($row);
}
print_r(json_encode($map_data))


?>