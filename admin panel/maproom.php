<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
  include "languages/spanish/maproom.php";
}
else{
  include "languages/english/maproom.php";
}



if(!isset($_SESSION['teacher_name']) && !isset($_SESSION['admin_name'])){
    
    $path = 'error.php';
    echo "<script>
   document.location= '$path';
    </script>";
   
    //header('Location: ../teacher panel/error.php');
    exit;
}

$school_name = $_GET["school"];
$floor = $_GET["floor"];
$room = $_GET["room"];

//To handle hashtag
$room = str_replace("HASHTAG",'#', $room);
$newroom = '"'.$_GET["room"].'"';
//To handle apostrophes
$newroom = str_replace("'","''", $newroom);
//To handle hashtag
$newroom = str_replace("HASHTAG",'#', $newroom);
//To Remove spaces
$newroom = str_replace(' ', '', $newroom);


// $roomquery =  "SELECT distinct s.id,s.grade,s.gender,s.d_gender,s.d_religion,s.d_race,s.d_S_orient,s.religion,s.race,s.s_orient as 'Orient',
// s.school_id,m.floor_id,json_extract(m.color_data , '$.".$newroom."')as room,s.guid FROM map_data m
// inner join survey_data s on s.guid = m.guid
// where m.floor_id = '".$floor."' AND m.school_id=".$school_name;

// $roomquery = "SELECT DISTINCT s.id, s.grade, s.gender, s.d_gender, s.d_religion, s.d_race, s.d_S_orient, s.religion, s.race, s.s_orient AS 'Orient', 
// s.school_id, m.floor_id, json_extract(m.color_data , '$.".$newroom."') AS room, s.guid 
// FROM map_data m 
// INNER JOIN survey_data s ON s.guid = m.guid 
// WHERE m.floor_id = '".$floor."' AND m.school_id = ".$school_name." AND json_extract(m.color_data , '$.".$newroom."') IS NOT NULL";

$roomquery = "SELECT DISTINCT s.id, s.grade, s.gender, s.d_gender, s.d_religion, s.d_race, s.d_S_orient, s.religion, s.race, s.s_orient AS 'Orient', 
s.school_id, m.floor_id, json_extract(REPLACE(m.color_data, ' ', ''), '$.".$newroom."') AS room, s.guid 
FROM map_data m 
INNER JOIN survey_data s ON s.guid = m.guid 
WHERE m.floor_id = '".$floor."' AND m.school_id = ".$school_name." AND json_extract(REPLACE(m.color_data, ' ', ''), '$.".$newroom."') IS NOT NULL";


$defineroomquery = "SELECT distinct s.grade,s.gender,s.d_gender,s.d_religion,s.d_race,s.d_S_orient,s.religion,s.race,s.s_orient as 'Orient',
s.school_id,m.floor_id,json_extract(m.color_data , '$.".$newroom."')as room,s.guid FROM map_data m
inner join survey_data s on s.guid = m.guid
where s.d_Gender not in ('Not Defined') and s.d_Religion not in ('Not Defined') and s.d_Race not in ('Not Defined') and s.d_S_orient not in ('Not Defined') and m.floor_id = '".$floor."' AND m.school_id=".$school_name;

 
$apply=0;
if(isset($_POST['apply'])){
$apply=1;

$newquery=$_POST['newquery'];
if($apply==1)
{
$sListfromDate1=$_POST['sListfromDate1'];
$sListtoDate1=$_POST['sListtoDate1'];
$sListGrade1=$_POST['sListGrade1'];
$sListGender1=$_POST['sListGender1'];
$sListdGender1=$_POST['sListdGender1'];
$sListdRace1=$_POST['sListdRace1'];
$sListdReligion1=$_POST['sListdReligion1'];
$sListd_S_orient1=$_POST['sListd_S_orient1'];
$sListReligion1=$_POST['sListReligion1'];
$sListRace1=$_POST['sListRace1'];
$sListOrient1=$_POST['sListOrient1'];
}
$school_name = $_GET["school"];
$floor = $_GET["floor"];
$room = $_GET["room"];
//To handle hashtag
$room = str_replace("HASHTAG",'#', $room);
$newroom = '"'.$_GET["room"].'"'; 
//To handle apostrophes
$newroom = str_replace("'","''", $newroom);
//To handle hashtag
$newroom = str_replace("HASHTAG",'#', $newroom);
//To Remove spaces
$newroom = str_replace(' ', '', $newroom);

// $roomquery =  "SELECT distinct s.grade,s.gender,s.d_gender,s.d_religion,s.d_race,s.d_S_orient,s.religion,s.race,s.s_orient as 'Orient',
// s.school_id,m.floor_id,json_extract(m.color_data , '$.".$newroom."')as room,s.guid FROM map_data m
// inner join survey_data s on s.guid = m.guid
// where m.floor_id = '".$floor."' AND m.school_id=".$school_name.$newquery;

// $roomquery = "SELECT DISTINCT s.grade, s.gender, s.d_gender, s.d_religion, s.d_race, s.d_S_orient, s.religion, s.race, s.s_orient AS 'Orient', s.school_id, m.floor_id, json_extract(m.color_data, '$.".$newroom."') AS room, s.guid 
// FROM map_data m 
// INNER JOIN survey_data s ON s.guid = m.guid 
// WHERE m.floor_id = '".$floor."' AND m.school_id = ".$school_name." AND json_extract(m.color_data, '$.".$newroom."') IS NOT NULL".$newquery;

$roomquery = "SELECT DISTINCT s.grade, s.gender, s.d_gender, s.d_religion, s.d_race, s.d_S_orient, s.religion, s.race, s.s_orient AS 'Orient', s.school_id, m.floor_id, json_extract(REPLACE(m.color_data, ' ', ''), '$.".$newroom."') AS room, s.guid 
FROM map_data m 
INNER JOIN survey_data s ON s.guid = m.guid 
WHERE m.floor_id = '".$floor."' AND m.school_id = ".$school_name." AND json_extract(REPLACE(m.color_data, ' ', ''), '$.".$newroom."')IS NOT NULL".$newquery;

}

?>
<!DOCTYPE html>
<html>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <link rel='stylesheet' href='https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css'>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script src="maproom.js"></script>
    

      
        <title><?php echo $room_report; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    
    <link rel="stylesheet" href="MapRoomStyle.css">
		<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
 </head>
    <body>

	  
      <script src="../plugin/charts/code/highcharts.js"></script>
<script src="../plugin/charts/code/modules/exporting.js"></script>
<script src="../plugin/charts/code/modules/export-data.js"></script>
<script src="../plugin/charts/code/modules/accessibility.js"></script>

<link rel="stylesheet" type="text/css" href="../plugin/datatables/datatables.css">


<script type="text/javascript" charset="utf8" src="../plugin/datatables/datatables.js"></script>
<script type="text/javascript">

 

$(document).ready(function() {
	
   $('#apply').click(function(){


    var sListfromDate = "";
       sListfromDate += " AND s.insertedOn between ('"
       var sListfromDate1= "";
        sListfromDate1 +="<?php echo $from; ?> [ "
       $('.from_date_check').each(function (){
       
    sListfromDate1 +=$(this).val();
    sListfromDate += $(this).val();
        
    });
    sListfromDate +=   "')";
    sListfromDate1 +=   " ]";
console.log (sListfromDate);


var sListtoDate = "";
       sListtoDate += " AND ('"
       var sListtoDate1= "";
        sListtoDate1 +="<?php echo $tospell; ?> [ "
       $('.to_date_check').each(function (){
       
    sListtoDate1 +=$(this).val();
    sListtoDate += $(this).val();
        
    });
    sListtoDate +=   "')";
    sListtoDate1 +=   " ]";
console.log (sListtoDate);



       var sListGrade = "";
       sListGrade += " and s.Grade in ("
       var sListGrade1= "";
       //sListGrade1 +="and Grade = ("
        sListGrade1 +="[ "
       $('.gradecheck').each(function () {
        if(this.checked)
        {
    sListGrade1 +=$(this).val() + " , ";
    sListGrade += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListGrade +=   ")";
    sListGrade = sListGrade.replace(",)",")");
    sListGrade1 +=   "]";
    sListGrade1 = sListGrade1.replace(" , ]"," ]");
console.log (sListGrade);


var sListGender = "";
       sListGender += " and s.Gender in ("
       var sListGender1= "";
        sListGender1 +="[ "
       $('.gendercheck').each(function () {
        if(this.checked)
        {
    sListGender1 +=$(this).val() + " , ";
    sListGender += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListGender +=   ")";
    sListGender = sListGender.replace(",)",")");
    sListGender1 +=   "]";
    sListGender1 = sListGender1.replace(" , ]"," ]");
  console.log (sListGender);




var sListReligion = "";
       sListReligion += " and s.Religion in ("
       var sListReligion1= "";
        sListReligion1 +="[ "
       $('.religioncheck').each(function () {
        if(this.checked)
        {
    sListReligion1 +=$(this).val() + " , ";
    sListReligion += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListReligion +=   ")";
    sListReligion = sListReligion.replace(",)",")");
    sListReligion1 +=   "]";
    sListReligion1 = sListReligion1.replace(" , ]"," ]");
console.log (sListReligion);

// var sListRace = "";
// sListRace += " and (s.Race like "
// var sListRace1= "";
// sListRace1 +="[ "
// $('.racecheck').each(function () {
// if(this.checked)
// {

// sListRace1 +=$(this).val() + " , ";
// sListRace += "'%"+ $(this).val() +"%'" + " or s.Race like" ;
// }
// });
// sListRace += " or)";
// sListRace = sListRace.replace("or s.Race like or)",")");
// console.log (sListRace);
// sListRace1 +=   "]";
// sListRace1 = sListRace1.replace(" , ]"," ]");


var sListRace = "";
sListRace += " and (s.Race REGEXP"
var sListRace1 = "";
sListRace1 += "[ ";
$('.racecheck').each(function () {
  if (this.checked) {
    sListRace1 += $(this).val() + " , ";
    sListRace += "'\[[:<:]]" + $(this).val() + "\[[:>:]]'" + " or s.Race REGEXP";
  }
});
sListRace += " '')";
sListRace = sListRace.replace("or s.Race REGEXP '')", ")");
console.log(sListRace);
sListRace1 += "]";
sListRace1 = sListRace1.replace(" , ]", " ]");



var sListOrient = "";
       sListOrient += " and s.s_Orient in ("
       var sListOrient1= "";
        sListOrient1 +="[ "
       $('.orientcheck').each(function () {
        if(this.checked)
        {
    sListOrient1 +=$(this).val() + " , ";
    sListOrient += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListOrient +=   ")";
    sListOrient = sListOrient.replace(",)",")");
    sListOrient1 +=   "]";
    sListOrient1 = sListOrient1.replace(" , ]"," ]");
console.log (sListOrient);





var sListdGender = "";
       sListdGender += " and s.d_Gender not in ("
       var sListdGender1= "";
        sListdGender1 +="[ "
       $('.d_gendercheck').each(function () {
        if(this.checked)
        {
    sListdGender1 +=$(this).val() + " , ";
    sListdGender += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListdGender +=   ")";
    sListdGender = sListdGender.replace(",)",")");
    sListdGender1 +=   "]";
    sListdGender1 = sListdGender1.replace(" , ]"," ]");
    sListdGender1 = sListdGender1.replace("[ Not Defined ]","Defined Gender");
  console.log (sListdGender);




  var sListdReligion = "";
       sListdReligion += " and s.d_Religion not in ("
       var sListdReligion1= "";
        sListdReligion1 +="[ "
       $('.d_religioncheck').each(function () {
        if(this.checked)
        {
    sListdReligion1 +=$(this).val() + " , ";
    sListdReligion += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListdReligion +=   ")";
    sListdReligion = sListdReligion.replace(",)",")");
    sListdReligion1 +=   "]";
    sListdReligion1 = sListdReligion1.replace(" , ]"," ]");
    sListdReligion1 = sListdReligion1.replace("[ Not Defined ]","Defined Religion");
  console.log (sListdReligion);


  var sListdRace = "";
       sListdRace += " and s.d_Race not in ("
       var sListdRace1= "";
        sListdRace1 +="[ "
       $('.d_racecheck').each(function () {
        if(this.checked)
        {
    sListdRace1 +=$(this).val() + " , ";
    sListdRace += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListdRace +=   ")";
    sListdRace = sListdRace.replace(",)",")");
    sListdRace1 +=   "]";
    sListdRace1 = sListdRace1.replace(" , ]"," ]");
    sListdRace1 = sListdRace1.replace("[ Not Defined ]","Defined Race");
  console.log (sListdRace);


  var sListd_S_orient = "";
       sListd_S_orient += " and s.d_S_orient not in ("
       var sListd_S_orient1= "";
        sListd_S_orient1 +="[ "
       $('.d_orientcheck').each(function () {
        if(this.checked)
        {
    sListd_S_orient1 +=$(this).val() + " , ";
    sListd_S_orient += '"'+ $(this).val()+'"' + "," ;
        }
    });
    sListd_S_orient +=   ")";
    sListd_S_orient = sListd_S_orient.replace(",)",")");
    sListd_S_orient1 +=   "]";
    sListd_S_orient1 = sListd_S_orient1.replace(" , ]"," ]");
    sListd_S_orient1 = sListd_S_orient1.replace("[ Not Defined ]","Defined Sexual Orientation");
  console.log (sListd_S_orient);
if(sListfromDate == " AND s.insertedOn between ('')" || sListtoDate == " AND ('')"){
  var newquery=sListGrade + sListGender + sListdGender + sListdReligion + sListdRace + sListd_S_orient + sListReligion + sListRace + sListOrient;
}
else{
var newquery=sListfromDate + sListtoDate + sListGrade + sListGender + sListdGender + sListdReligion + sListdRace + sListd_S_orient + sListReligion + sListRace + sListOrient;
}

//newquery= (newquery.replace("and s.Grade in ()","").replace("and s.Gender in ()","").replace("and s.d_Gender not in ()","").replace("and s.d_Religion not in ()","").replace("and s.d_Race not in ()","").replace("and s.d_S_orient not in ()","").replace("and s.Religion in ()","").replace("and (s.Race like  or)","").replace("and s.s_Orient in ()",""));
newquery= (newquery.replace("and s.Grade in ()","").replace("and s.Gender in ()","").replace("and s.d_Gender not in ()","").replace("and s.d_Religion not in ()","").replace("and s.d_Race not in ()","").replace("and s.d_S_orient not in ()","").replace("and s.Religion in ()","").replace(" and (s.Race REGEXP '')","").replace("and s.s_Orient in ()",""));
$('#newquery').val(newquery);

console.log(newquery);




sListfromDate1=sListfromDate1.replace("<?php echo $from;?> [  ]","<?php echo $not_selected_date; ?>")
$('#sListfromDate1').val(sListfromDate1);

sListtoDate1=sListtoDate1.replace("<?php echo $tospell;?> [  ]","<?php echo $not_selected_date; ?>")
$('#sListtoDate1').val(sListtoDate1);

sListGrade1=sListGrade1.replace("[ ]","<?php echo $not_selected; ?>")
$('#sListGrade1').val(sListGrade1);

sListGender1=sListGender1.replace("[ ]","<?php echo $not_selected; ?>")
$('#sListGender1').val(sListGender1);

sListdGender1=sListdGender1.replace("[ ]","")
$('#sListdGender1').val(sListdGender1);

sListdReligion1=sListdReligion1.replace("[ ]","")
$('#sListdReligion1').val(sListdReligion1);

sListdRace1=sListdRace1.replace("[ ]","")
$('#sListdRace1').val(sListdRace1);

sListd_S_orient1=sListd_S_orient1.replace("[ ]","")
$('#sListd_S_orient1').val(sListd_S_orient1);

sListReligion1=sListReligion1.replace("[ ]","<?php echo $not_selected; ?>")
$('#sListReligion1').val(sListReligion1);

sListRace1=sListRace1.replace("[ ]","<?php echo $not_selected; ?>")
$('#sListRace1').val(sListRace1);

sListOrient1=sListOrient1.replace("[ ]","<?php echo $not_selected; ?>")
$('#sListOrient1').val(sListOrient1);

   });

	
	 
} );
</script>
        <div class="container-fluid">
            <form method='POST' action=''>
            <input type="hidden"name="newquery"id="newquery"value="">
            <input type="hidden" name="room" id="room" value="<?php echo $room?>">
            <input type="hidden" name="sListfromDate1" id="sListfromDate1" value="<?php echo $sListfromDate1?>">
            <input type="hidden" name="sListtoDate1" id="sListtoDate1" value="<?php echo $sListtoDate1?>">
            <input type="hidden" name="sListGrade1" id="sListGrade1" value="<?php echo $sListGrade1?>">
            <input type="hidden" name="sListGender1" id="sListGender1" value="<?php echo $sListGender1?>">
            <input type="hidden" name="sListdGender1" id="sListdGender1" value="<?php echo $sListdGender1?>">
            <input type="hidden" name="sListdRace1" id="sListdRace1" value="<?php echo $sListdRace1?>">
            <input type="hidden" name="sListdReligion1" id="sListdReligion1" value="<?php echo $sListdReligion1?>">
            <input type="hidden" name="sListd_S_orient1" id="sListd_S_orient1" value="<?php echo $sListd_S_orient1?>">
            <input type="hidden" name="sListReligion1" id="sListReligion1" value="<?php echo $sListReligion1?>">
            <input type="hidden" name="sListRace1" id="sListRace1" value="<?php echo $sListRace1?>">
            <input type="hidden" name="sListOrient1" id="sListOrient1" value="<?php echo $sListOrient1?>">
           
            
            <div class="row upper-container">
                
                <input type="hidden" value="<?php echo $school_name?>" name="school" id="school">
                <div class="col-12">
                    <img class="float-right one" src="../pics/6.png"  class="img-fluid responsive" />

                </div>

                <div class="col-12">
                    <h1 class="heading text-uppercase"><?php echo $room_analysis; ?></h1>
            
                </div>

                <div class="col-12 d-flex justify-content-center align"> 
            
                <?php 

                
                $query="SELECT DISTINCT sname,s_type FROM school_map  where status = 1  AND id= ".$school_name;
                $sql = mysqli_query($con, $query );          
                $row = $sql->fetch_assoc()?>
               
               <span class="badge badge-primary"><h3 class=heading1><?php echo  $row['sname']." ". $row['s_type'] ?></h3>
               
               
            </span> 
                
    
      
  

                       
            </div>
            
            
  
        
                  
                </div>

                <div class="row lower-container">

    

                
                
                <?php if($apply==0): {?>
                
<div class="col-lg-3 noprint"id="blue">
<center>
<div class=" container well"><p class="display-1 "> <h1><span class="badge badge-info"><?php echo $filters; ?></span></h1></p></div></center> 


    
      <div class="form-check mb-4">
      <img src="../pics/34.png"class="logo-image" alt="">
           <h6><?php echo $select_date; ?></h6>
           <div class="d-flex justify-content-center mt-2  date">
     
           <input id="datepicker1" type="text" class="from_date_check" name="fromDate"placeholder="<?php echo $from; ?>" value="">
      </div>
      <div class="d-flex justify-content-center mt-2 date">
      
           <input id="datepicker2"type="text" class="to_date_check" name="toDate"placeholder="<?php echo $tospell; ?>"value="">
       </div>
           
      </div>
     


   

           
    <div class="form-check">
        <img src="../pics/21.png"class="logo-image" alt="">  
             <h6><?php echo $gradel; ?></h6>
                
                              
                     <?php 
                     $GradeArr = [];

                     $GradeArr = array_unique( $GradeArr );
                            $sql = mysqli_query($con,$roomquery);
                            
							while ($row = $sql->fetch_assoc()){
                                array_push($GradeArr,$row['grade']);
                                
                            }
                            $GradeArr = array_unique($GradeArr);
                            sort($GradeArr);
                          
                            foreach ( $GradeArr as $arr ) {
                                ?>
                                <label class="form-check" for="grade">
                                <input type="checkbox"class="form-check-input gradecheck"   name="grade" value="<?php echo  $arr ?>"><?php echo $arr ?>
                              </label>
                                  

                              <?php 
                            }
						?>
                 
                
               </div>
               <br>


             <div class="form-check">
             <img src="../pics/22.png"class="logo-image" alt="">
           <h6><?php echo $gender_i; ?></h6>
                 <label class="form-check" for="gender">
                     <input type="checkbox" class="form-check-input gendercheck"  name="gender" value="Agender"><?php echo $agender; ?>
                 </label>
                 <label class="form-check checkbox" for="gender">
                   <input type="checkbox"class="form-check-input gendercheck"  name="gender" value="Female" ><?php echo $female; ?>
                 </label>
                 <label class="form-check" for="gender">
                     <input type="checkbox" class="form-check-input gendercheck"  name="gender" value="Male"><?php echo $male; ?>
                 </label>
               
     
                 <label class="form-check" for="gender">
                     <input type="checkbox" class="form-check-input gendercheck"  name="gender" value="Transgender"><?php echo $transgender; ?>
                 </label>
                 <label class="form-check"style=" " for="gender">
                     <input type="checkbox" class="form-check-input gendercheck" name="gender" value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                 <label class="form-check" for="d_gender">
                     <input type="checkbox" class="form-check-input d_gendercheck"  name="d_gender" value="Not Defined"><?php echo $prefer_define; ?>
                 </label>
              
               
             </div>
           

             <br>
             
             <div class="form-check">
             <img src="../pics/23.png"class="logo-image" alt="">
             <h6><?php echo $religionl; ?></h6>
                 <label class="form-check" for="religion">
                   <input type="checkbox"class="form-check-input religioncheck"name="religion" value="Christian" ><?php echo $christian; ?>
                 </label>
                 <label class="form-check" for="religion">
                   <input type="checkbox"class="form-check-input religioncheck"name="religion" value="Hindu" ><?php echo $hindu; ?>
                 </label>
                 <label class="form-check" for="religion">
                   <input type="checkbox"class="form-check-input religioncheck"name="religion" value="Jewish" ><?php echo $jewish; ?>
                 </label>
                 <label class="form-check" for="religion">
                   <input type="checkbox"class="form-check-input religioncheck"name="religion" value="Muslim" ><?php echo $muslim; ?>
                 </label>
                 <label class="form-check" for="religion">
                     <input type="checkbox" class="form-check-input religioncheck" name="religion" value="Non-Mainstream Religion(i.e. Polytheism,Wiccan)"><?php echo $non_main1; ?><br><?php echo $non_main2; ?>
                 </label>
                 <label class="form-check" for="religion">
                     <input type="checkbox"class="form-check-input religioncheck"  name="religion" value="No Religion" ><?php echo $noReligion; ?>
                   </label>
                
                 <label class="form-check" for="religion">
                     <input type="checkbox"class="form-check-input religioncheck" name="religion" value="Questioning" ><?php echo $questioning; ?>
                   </label>
                   <label class="form-check" for="religion">
                     <input type="checkbox"class="form-check-input religioncheck" name="religion" value="Sikh" ><?php echo $sikh; ?>
                   </label>
                      
                 <label class="form-check"style=" " for="religion">
                     <input type="checkbox" class="form-check-input religioncheck" name="religion"value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                   <label class="form-check" for="d_religion">
                     <input type="checkbox" class="form-check-input d_religioncheck"  name="d_religion" value="Not Defined"><?php echo $prefer_define; ?>
                 </label>
      
             </div>


             
             <br>
             <div class="form-check">
             <img src="../pics/24.png"class="logo-image" alt="">
             <h6><?php echo $race_e; ?></h6>
                 <label class="form-check" for="race">
                   <input type="checkbox"class="form-check-input racecheck" name="race" value="Asian" ><?php echo $asian; ?>
                 </label>
                 <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck" name="race" value="Biracial or Multiracial" ><?php echo $multiracial; ?>
                   </label>
                 <label class="form-check" for="race">
                     <input type="checkbox" class="form-check-input racecheck" name="race" value="Black/African"><?php echo $african; ?>
                 </label>
                 <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck" name="race" value="Hispanic/Latinx" ><?php echo $latinx; ?>
                   </label>
                   <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck" name="race" value="Middle Eastern" ><?php echo $eastern; ?>
                   </label>
                 <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck" name="race" value="Native American" ><?php echo $american; ?>
                   </label>
                 <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck" name="race" value="Pacific Islander" ><?php echo $pacific; ?>
                   </label>
                  
                
                 <label class="form-check" for="race">
                     <input type="checkbox"class="form-check-input racecheck"name="race" value="White/Caucasian" ><?php echo $white; ?>
                   </label>
                   <label class="form-check"style=" " for="race">
                     <input type="checkbox" class="form-check-input racecheck" name="race" value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                   <label class="form-check" for="d_race">
                     <input type="checkbox" class="form-check-input d_racecheck"  name="d_race" value="Not Defined"><?php echo $prefer_define; ?>
                 </label>
                
                 
             </div>


            <br>

             
             <div class="form-check">
             <img src="../pics/25.png"class="logo-image" alt="">
             <h6><?php echo $s_orientationl; ?></h6>
                 <label class="form-check" for="S_orient">
                   <input type="checkbox"class="form-check-input orientcheck" name="S_orient" value="Bisexual" ><?php echo $bisexual; ?>
                 </label>
                 <label class="form-check" for="S_orient">
                     <input type="checkbox" class="form-check-input orientcheck" name="S_orient" value="Gay"><?php echo $gay; ?>
                 </label>
                 <label class="form-check" for="S_orient">
                     <input type="checkbox"class="form-check-input orientcheck" name="S_orient" value="Lesbian" ><?php echo $lesbian; ?>
                   </label>
                   <label class="form-check" for="S_orient">
                     <input type="checkbox"class="form-check-input orientcheck" name="S_orient" value="Pansexual" ><?php echo $pansexual; ?>
                   </label>
                  
                 <label class="form-check" for="S_orient">
                     <input type="checkbox"class="form-check-input orientcheck" name="S_orient" value="Questioning" ><?php echo $questioning; ?>
                   </label>
                 <label class="form-check" for="S_orient">
                     <input type="checkbox"class="form-check-input orientcheck" name="S_orient" value="Straight" ><?php echo $straight; ?>
                   </label>
                   <label class="form-check"style=" " for="S_orient">
                     <input type="checkbox" class="form-check-input orientcheck" name="S_orient" value="Prefer Not to Answer"><?php echo $prefer_not; ?>
                 </label>
                   <label class="form-check" for="d_S_orient">
                     <input type="checkbox"class="form-check-input d_orientcheck" name="d_S_orient" value="Not Defined" ><?php echo $prefer_define; ?>
                   </label>
                   
                
             </div>
             <br>
     

             <center>
<input type="submit" name="apply" id="apply" value="<?php echo $apply_b; ?>" class="btn btn-apply btn-lg"/>  </center>

 <?php } else:{ ?> <div class="col-lg-3"id="blue">
    <?php if($sListfromDate1 !=$not_selected_date ||$sListtoDate1 !=$not_selected_date || $sListGrade1 !=$not_selected || $sListGender1 !=$not_selected || $sListdGender1 !="" || $sListdRace1 !="" || $sListdReligion1 !="" || $sListd_S_orient1 !=""|| $sListReligion1 !=$not_selected || $sListRace1!=$not_selected || $sListOrient1!=$not_selected):{ 
     
      ?>

<center>
   <div class=" container well "><p class="display-4 "> <h1><span class="badge badge-success"><?php echo $filters_applied; ?></span></h1></p></div>
   </center>
   <div class="form-check">

   <img src="../pics/34.png"class="logo-image" alt="">
   <h6><?php echo $select_date; ?></h6>
   <?php if($sListfromDate1 !=$not_selected_date && $sListtoDate1 !=$not_selected_date){?>
    <div class="move"><?php echo $sListfromDate1; ?></div>
    <div class="move mr-3"><?php echo $sListtoDate1; ?></div>


    <?php }elseif($sListfromDate1 ==$not_selected_date && $sListtoDate1 ==$not_selected_date) {?>

      <div class="move"><?php echo $not_selected; ?></div>





      <?php }else {?>

      <div class="move alert alert-warning ml-3" role="alert">
  <?php echo $date_error; ?>
</div>

<?php } ?>
       
       
       
       <img src="../pics/21.png"class="logo-image" alt="">  
             <h6><?php echo $gradel; ?></h6>
    <div class="move"><?php echo $sListGrade1; ?></div>


    <img src="../pics/22.png"class="logo-image" alt="">
           <h6><?php echo $gender_i; ?></h6>
     <div class="move"><?php echo $sListGender1; ?></div>
     <div class="move"><?php echo $sListdGender1; ?></div>


     <img src="../pics/23.png"class="logo-image" alt="">
           <h6>Religion</h6>
     <div class="move"><?php echo $sListReligion1; ?></div>
     <div class="move"><?php echo $sListdReligion1; ?></div>


     <img src="../pics/24.png"class="logo-image" alt="">
           <h6><?php echo $race_e; ?></h6>
     <div class="move"><?php echo $sListRace1; ?></div>
     <div class="move"><?php echo $sListdRace1; ?></div>



     <img src="../pics/25.png"class="logo-image" alt="">
           <h6><?php echo $s_orientationl; ?></h6>
     <div class="move"><?php echo $sListOrient1; ?></div>
     <div class="move"><?php echo $sListd_S_orient1; ?></div>
   


    </div>
    <center>
    <input type="submit" name="" id="" onclick="window.reload()" value="Reset" class="btn btn-reset btn-lg noprint"/> 
    </center>
 
    <?php 
  } 
else:{?>
<center>
<div class=" container well "><p class="display-1 "> <h1><span class="badge badge-info"><?php echo $filters; ?></span></h1></p></div></center> 
</center>
<div class="alert alert-warning ml-2" role="alert">
  <?php echo $filters_d; ?>
</div>
<center>
    <input type="submit" name="" id="" onclick="window.reload()" value="<?php echo $back; ?>" class="btn btn-danger btn-lg noprint"/>
    </center>
 
<?php 
        

  }
endif;
 }

  endif;?>

  <br>

	</div>
<div class="col-lg-9">


  <div class="row">
  
	
	 <div class="col-lg-12 col-md-12 ">
   <div class="col-12">
                    <h2 class="heading3"><?php if($school_name==21 || $school_name==1):{echo"";} else: { echo $floor_nav;} endif; ?> <?php echo  $floor ?></h2>
            
                </div>


   <div class="col-12 d-flex justify-content-center pt-4">

   <span class="badge badge-secondary"><h4 id="room_name"class="heading2 mt-2"><?php echo $room ?></h4>

     </div>

       
<figure class="highcharts-figure">
    <div id="piechart" width="100%"></div>
    <p class="highcharts-description">
 &nbsp;
    </p>
</figure>
	 </div>
  
<div class="col-md-12"> 
<center> <div class=" container well"><p class="display-4 details"><?php echo $details; ?></p></div></center>


    <div class="table-responsive" >
<table class="table table-striped table-hover " id="dtTable" width="100%">

      <tr class="thead">
	    <th> <h3><span class="badge badge-info1"><?php echo $gradel; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $genderl; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $religionl; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $racel; ?></span></h3></th>
	    	<th> <h3><span class="badge badge-info1"><?php echo $s_orientationl; ?></span></h3></th>
		    <th> <h3><span class="badge badge-info1"><?php echo $value_t; ?></span></h3></th>
		 
	 
      </tr>
 
    <tbody>
      <?php 
      $arr = [];
$sql = mysqli_query($con,$roomquery);
$red = 0 ;
$green = 0 ;
$yellow= 0; $grey =0; $count = 0;

while ($row = $sql->fetch_assoc()){
    array_push($arr,$row);
$count++;
if(json_decode($row['room']) == "grey")
    {
        $grey++;
    }
    if(json_decode($row['room']) == "red")
    {
        $red++;
    }
    if(json_decode($row['room']) == "green")
    {
        $green++;
    }
    if(json_decode($row['room']) == "yellow")
    {
        $yellow++;
    }
       

        
echo "<tr>"."

"."<td>".$row['grade']."</td>
"."<td>".$row['gender']."</td>
"."<td>".$row['religion']."</td>
"."<td>".$row['race']."</td>
"."<td>".$row['Orient']."</td>
"."<td>".json_decode($row['room'])."</td>
 
"."</tr>";
}

?>
    </tbody>
  </table>
  </div>
</div>
<br>
<div class="col-md-12"> 
  <center> <div class=" container well"><p class="display-4 details"><?php echo $defined_details; ?></p></div></center>
  
  
      <div class="table-responsive" >
  <table class="table table-striped table-hover " id="dtTable" width="100%">
  
        <tr class="thead">
        <th> <h3><span class="badge badge-info1"><?php echo $gradel; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_gender; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_religion; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_race; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_orientation; ?></span></h3></th>
       
     
        </tr>
   
      <tbody>
        <?php 
        $arr = [];
  $sql = mysqli_query($con,$roomquery);
  $red = 0 ;
  $green = 0 ;
  $yellow= 0; $grey =0; $count = 0;
  
  while ($row = $sql->fetch_assoc()){
      array_push($arr,$row);
  $count++;
  if(json_decode($row['room']) == "grey")
      {
          $grey++;
      }
      if(json_decode($row['room']) == "red")
      {
          $red++;
      }
      if(json_decode($row['room']) == "green")
      {
          $green++;
      }
      if(json_decode($row['room']) == "yellow")
      {
          $yellow++;
      }
         
  
          
  echo "<tr>"."
  
  "."<td>".$row['grade']."</td>
  "."<td>".$row['d_gender']."</td>
  "."<td>".$row['d_religion']."</td>
  "."<td>".$row['d_race']."</td>
  "."<td>".$row['d_S_orient']."</td>
   
  "."</tr>";
  }
  
  ?>
      </tbody>
    </table>
    </div>
  </div>
  <br>

      
      </div> 






      <div class="table-responsive hide">
<table class="table table-striped table-hover" id="dtTable" width="100%">

      <tr class="thead">
      <th> <h3><span class="badge badge-info1"><?php echo $idt; ?></span></h3></th>
	    <th> <h3><span class="badge badge-info1"><?php echo $gradel; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $genderl; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $religionl; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $racel; ?></span></h3></th>
	    	<th> <h3><span class="badge badge-info1"><?php echo $s_orientationl; ?></span></h3></th>
		    <th> <h3><span class="badge badge-info1"><?php echo $value_t; ?></span></h3></th>
        <th> <h3><span class="badge badge-info1"><?php echo $defined_gender; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_religion; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_race; ?></span></h3></th>
          <th> <h3><span class="badge badge-info1"><?php echo $defined_orientation; ?></span></h3></th>
		 
	 
      </tr>
 
    <tbody>
      <?php 
      $arr = [];
$sql = mysqli_query($con,$roomquery);
$red = 0 ;
$green = 0 ;
$yellow= 0; $grey =0; $count = 0;

while ($row = $sql->fetch_assoc()){
    array_push($arr,$row);
$count++;
if(json_decode($row['room']) == "grey")
    {
        $grey++;
    }
    if(json_decode($row['room']) == "red")
    {
        $red++;
    }
    if(json_decode($row['room']) == "green")
    {
        $green++;
    }
    if(json_decode($row['room']) == "yellow")
    {
        $yellow++;
    }
       

        
echo "<tr>"."
"."<td data-t='n'>".$row['id']."</td>
"."<td data-t='n'>".$row['grade']."</td>
"."<td>".$row['gender']."</td>
"."<td>".$row['religion']."</td>
"."<td>".$row['race']."</td>
"."<td>".$row['Orient']."</td>
"."<td>".json_decode($row['room'])."</td>
"."<td>".$row['d_gender']."</td>
"."<td>".$row['d_religion']."</td>
"."<td>".$row['d_race']."</td>
"."<td>".$row['d_S_orient']."</td>
 
"."</tr>";
}

?>
    </tbody>
  </table>
  </div>

<?php

$urlquery='SELECT DISTINCT id,url FROM school_floor  where status=1 AND school_id="'.$school_name.'"AND floorlevel="'.$floor.'"';
$sql = mysqli_query($con, $urlquery );
$row = mysqli_fetch_array($sql);

?>



</form>


<div class="container">
<div style="position:relative" class="svg-element">
  <object  type="image/svg+xml" id="alphasvg" data="<?php echo "../admin panel/".$row['url'] ?>"></object>
  <div style="position:absolute" id="info-box">
  </div>
  
</div>
</div>
<form method="post"action="">
<a href="#" class="btn print_btn float-right mr-3 mb-2 noprint" id="print_btn"><?php echo $print; ?></a>
</form>
<form method="post"action="">
<a href="#" id="btnExport"class=" float-right noprint btn print_btn mr-2" onclick="exportReportToExcel(this)"><?php echo $excel_download; ?></a>
</form>
</div>


</div>


</div>


       

      </div>

      <script>
 function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[2], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `Room Report.xlsx`, // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}
 </script>


 <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
 
     
	 <script type="text/javascript">
// Build the chart
var room_name=document.querySelector("#room_name").innerHTML;
Highcharts.chart('piechart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: room_name,
       
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [{ name:'<?php echo $unsafe;?>',y:<?php echo ($red*100)/$count; ?>,color:'red' },
        { name:'<?php echo $safe;?>' ,y:<?php echo ($green*100)/$count; ?>,color:'green' },
        { name:'<?php echo $inbetween;?>',y:<?php echo ($yellow*100)/$count; ?>,color:'yellow' },
        { name:'<?php echo $never_go;?>',y:<?php echo ($grey*100)/$count; ?>,color:'lightgrey' }
        

		
		
		]
    }]
    
});

document.querySelector("tspan").classList.add("hide");
		</script>


        <script>
        var today, datepicker1,datepicker2,datepicker3,datepicker4;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
        datepicker1 = $('#datepicker1').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker2 = $('#datepicker2').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker3 = $('#datepicker3').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker4 = $('#datepicker4').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });
    </script>

            <script src='https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js'></script>
 
	    
     
    </body>
</html>

