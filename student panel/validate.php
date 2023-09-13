<?php
include "../config.php";

//$content_raw = file_get_contents("php://input"); // THIS IS WHAT YOU NEED
//$decoded_data = json_decode($content_raw, true); // THIS IS WHAT YOU NEED
//echo $decoded_data;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data=$_POST["data"];
    $data = json_encode($data,JSON_UNESCAPED_SLASHES);
    //print_r($data);
    
    
    
    $floor_id=$_POST["floor_id"];
    $school_id=$_POST["school_id"];
    $guid=$_POST["guid"];
    
    $_SESSION['array'][$floor_id]= $data;
    //print_r($_SESSION['array']);
    //$_SESSION[$floor_id] = $floor_id;
    
    //print_r($_POST["last"]);
    if($_POST["last"]=="true"){
        
        foreach ($_SESSION['array'] as $key => $value) {  
            //print_r($key);
            $SQL="INSERT INTO map_data(color_data,school_id,floor_id,guid) values(?,?,?,?)";
            $stmt = $con->prepare($SQL);
            $stmt->bind_param("ssss",$value,$school_id,str_replace("floor","",$key),$guid);
            $stmt->execute();
            $stmt->close();
           }
    
           $insertSQL = "INSERT INTO survey_data(school_id,grade,gender,d_gender,religion,d_religion,race,d_race,S_orient,d_S_orient,guid ) values(?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $con->prepare($insertSQL);
            $stmt->bind_param("sssssssssss",$_SESSION['school_id'],$_SESSION['grade'],
            $_SESSION['gender'],
            $_SESSION['d_gender'],
            $_SESSION['religion'],
            $_SESSION['d_religion'],
            $_SESSION['race'],
            $_SESSION['d_race'],
            $_SESSION['S_orient'],
            $_SESSION['d_S_orient'],
            $_SESSION['guid']);
            $stmt->execute();
            $stmt->close();
            
    
            //session_destroy();
            foreach ($_SESSION as $xxx ){
                if(!($xxx=="English"))
                {
                unset($_SESSION[$xxx]);
                }
            }
    
    }
    
    //$SQL="UPDATE `user_data` SET `Floor1`=? WHERE uname=?";
    
    
    
    //$SQL="INSERT INTO map_data(color_data,school_id,floor_id) values(?,?,?)";
    //$stmt = $con->prepare($SQL);
    //$stmt->bind_param("sss",$data,$school_id,str_replace("floor","",$floor_id));
    //$stmt->execute();
    //$stmt->close();
    
    
    
    //$insertSQL = "UPDATE user_data(Floor1) WHERE id=4 values(?) ";
    //$stmt = $con->prepare($insertSQL);
    //$stmt->bind_param("s",$data);
    //$stmt->execute();
    //$stmt->close();
    //$success_message = "Account created successfully.";

}

else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // The request is using the GET method
    $floor_id = $_GET['floor_id'];

    if(isset($_SESSION['array'][$floor_id])){
    $result = $_SESSION['array'][$floor_id];
    echo json_encode($_SESSION['array']);
    }
    else{
    echo json_encode(null);
    
}

}



?>
