
<?php
include "../config.php";

$floor_id = $_GET['floor_id'];

if(isset($_SESSION['array'][$floor_id])){
    $result = $_SESSION['array'][$floor_id];
    echo json_encode($_SESSION['array']);
}
else{
    echo json_encode(null);
}





?>